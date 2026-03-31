<?php

declare(strict_types=1);

namespace App\Modules\Sentry;

use App\Models\User;
use App\RandomPhraseGenerator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Validation\ValidationException;
use Sentry\SentrySdk;
use Sentry\State\Scope;
use Sentry\Tracing\TransactionContext;
use Sentry\Tracing\SpanContext;

trait Common
{
    public function setupSentryLogger(): void
    {
        ray()->disable();
        logger()->setDefaultDriver('null');
    }

    /** @test */
    function sentryReport(RandomPhraseGenerator $generator): void
    {
        try {
            Artisan::call('migrate:fresh', ['--force' => true]);
            Artisan::call('db:seed', ['--force' => true]);
            throw new \Exception($generator->generateException('Buggregator'));
        } catch (\Throwable $e) {
            report($e);
        }
    }

    /** @test */
    function sentryEvent(RandomPhraseGenerator $generator): void
    {
        Artisan::call('migrate:fresh', ['--force' => true]);
        Artisan::call('db:seed', ['--force' => true]);

        SentrySdk::getCurrentHub()->captureMessage($generator->generateException('Buggregator'));
    }

    /** @test */
    function sentryModelNotFound(): void
    {
        try {
            User::findOrFail(99999);
        } catch (ModelNotFoundException $e) {
            report($e);
        }
    }

    /** @test */
    function sentryValidation(): void
    {
        try {
            throw ValidationException::withMessages([
                'email' => ['The email field is required.', 'The email must be a valid email address.'],
                'password' => ['The password must be at least 8 characters.'],
            ]);
        } catch (ValidationException $e) {
            report($e);
        }
    }

    /** @test */
    function sentryWithContext(RandomPhraseGenerator $generator): void
    {
        \Sentry\configureScope(function (Scope $scope): void {
            $scope->setUser([
                'id' => 42,
                'email' => 'john@example.com',
                'username' => 'john_doe',
            ]);
            $scope->setTag('environment', 'staging');
            $scope->setTag('feature', 'checkout');
            $scope->setExtra('cart_items', 3);
            $scope->setExtra('total_amount', 149.99);
        });

        try {
            throw new \RuntimeException($generator->generateException('PaymentService'));
        } catch (\Throwable $e) {
            report($e);
        }
    }

    /** @test */
    function sentryNestedExceptions(): void
    {
        try {
            try {
                throw new \InvalidArgumentException('Invalid product ID format');
            } catch (\InvalidArgumentException $inner) {
                throw new \RuntimeException('Failed to process order #12345', 0, $inner);
            }
        } catch (\RuntimeException $e) {
            report($e);
        }
    }

    /** @test */
    function sentryDatabaseError(): void
    {
        try {
            \Illuminate\Support\Facades\DB::select('SELECT * FROM non_existing_table');
        } catch (\Throwable $e) {
            report($e);
        }
    }

    /** @test */
    function sentryTypeError(): void
    {
        try {
            $this->causeTypeError(null);
        } catch (\TypeError $e) {
            report($e);
        }
    }

    private function causeTypeError(string $value): void
    {
        // This will never execute — TypeError thrown before
    }

    /** @test */
    function sentryTrace(): void
    {
        Artisan::call('migrate:fresh', ['--force' => true]);
        Artisan::call('db:seed', ['--force' => true]);

        $transactionContext = new TransactionContext();
        $transactionContext->setName('GET /api/users');
        $transactionContext->setOp('http.server');

        $transaction = SentrySdk::getCurrentHub()->startTransaction($transactionContext);
        SentrySdk::getCurrentHub()->setSpan($transaction);

        // DB query span
        $dbContext = new SpanContext();
        $dbContext->setOp('db.query');
        $dbContext->setDescription('SELECT * FROM users WHERE active = 1');
        $dbContext->setData(['server.address' => 'mysql:3306', 'db.name' => 'app']);
        $dbSpan = $transaction->startChild($dbContext);

        // Actually query the DB
        User::all();
        $dbSpan->finish();

        // HTTP client span
        $httpContext = new SpanContext();
        $httpContext->setOp('http.client');
        $httpContext->setDescription('POST https://api.stripe.com/v1/charges');
        $httpContext->setData(['http.url' => 'https://api.stripe.com/v1/charges', 'http.method' => 'POST']);
        $httpSpan = $transaction->startChild($httpContext);
        usleep(50_000); // simulate 50ms latency
        $httpSpan->finish();

        // Cache span
        $cacheContext = new SpanContext();
        $cacheContext->setOp('cache.get');
        $cacheContext->setDescription('user:permissions:42');
        $cacheContext->setData(['server.address' => 'redis:6379']);
        $cacheSpan = $transaction->startChild($cacheContext);
        usleep(5_000); // simulate 5ms
        $cacheSpan->finish();

        $transaction->finish();
    }

    /** @test */
    function sentryTraceWithError(): void
    {
        $transactionContext = new TransactionContext();
        $transactionContext->setName('POST /api/checkout');
        $transactionContext->setOp('http.server');

        $transaction = SentrySdk::getCurrentHub()->startTransaction($transactionContext);
        SentrySdk::getCurrentHub()->setSpan($transaction);

        // DB span
        $dbContext = new SpanContext();
        $dbContext->setOp('db.query');
        $dbContext->setDescription('INSERT INTO orders (user_id, total) VALUES (42, 99.99)');
        $dbContext->setData(['server.address' => 'mysql:3306']);
        $dbSpan = $transaction->startChild($dbContext);
        usleep(30_000);
        $dbSpan->finish();

        // HTTP call that fails
        $httpContext = new SpanContext();
        $httpContext->setOp('http.client');
        $httpContext->setDescription('POST https://payment-gateway.example.com/charge');
        $httpContext->setData(['http.url' => 'https://payment-gateway.example.com/charge']);
        $httpSpan = $transaction->startChild($httpContext);
        usleep(100_000); // simulate slow call

        // Report error within the span context
        try {
            throw new \RuntimeException('Payment gateway connection refused: ECONNREFUSED');
        } catch (\Throwable $e) {
            report($e);
        }

        $httpSpan->setStatus(\Sentry\Tracing\SpanStatus::internalError());
        $httpSpan->finish();

        // Queue span
        $queueContext = new SpanContext();
        $queueContext->setOp('queue.publish');
        $queueContext->setDescription('order-failed-notifications');
        $queueContext->setData(['messaging.destination' => 'order-failed-queue']);
        $queueSpan = $transaction->startChild($queueContext);
        usleep(10_000);
        $queueSpan->finish();

        $transaction->setStatus(\Sentry\Tracing\SpanStatus::internalError());
        $transaction->finish();
    }

    /** @test */
    function sentryLogs(): void
    {
        // Sentry native logs require SDK v4.10+. Since we're on v3, send a raw envelope.
        $dsn = config('sentry.dsn');
        if (!$dsn) {
            return;
        }

        $parsed = parse_url($dsn);
        $baseUrl = ($parsed['scheme'] ?? 'http') . '://' . ($parsed['host'] ?? 'localhost');
        if (isset($parsed['port'])) {
            $baseUrl .= ':' . $parsed['port'];
        }

        $traceId = bin2hex(random_bytes(16));
        $now = microtime(true);

        $logs = [
            ['trace_id' => $traceId, 'level' => 'info', 'severity_number' => 9, 'body' => 'User authentication successful', 'timestamp' => $now - 0.5, 'attributes' => ['user.id' => 42, 'user.email' => 'john@example.com', 'sentry.message.template' => 'User %s authentication successful']],
            ['trace_id' => $traceId, 'level' => 'info', 'severity_number' => 9, 'body' => 'Fetching user preferences from cache', 'timestamp' => $now - 0.4, 'attributes' => ['cache.key' => 'user:prefs:42', 'cache.hit' => true]],
            ['trace_id' => $traceId, 'level' => 'warning', 'severity_number' => 13, 'body' => 'Slow database query detected: 245ms', 'timestamp' => $now - 0.3, 'attributes' => ['db.statement' => 'SELECT * FROM orders WHERE user_id = 42 ORDER BY created_at DESC', 'db.duration_ms' => 245]],
            ['trace_id' => $traceId, 'level' => 'error', 'severity_number' => 17, 'body' => 'Failed to send notification email: SMTP timeout', 'timestamp' => $now - 0.1, 'attributes' => ['smtp.host' => 'mail.example.com', 'smtp.port' => 587, 'error.code' => 'ETIMEDOUT']],
            ['level' => 'debug', 'severity_number' => 5, 'body' => 'Request completed', 'timestamp' => $now, 'attributes' => ['http.status_code' => 200, 'http.method' => 'GET', 'http.route' => '/api/users/42']],
        ];

        $envelopeHeader = json_encode(['sent_at' => gmdate('Y-m-d\TH:i:s\Z')]);
        $itemHeader = json_encode(['type' => 'log']);
        $itemBody = json_encode(['items' => $logs]);

        $envelope = $envelopeHeader . "\n" . $itemHeader . "\n" . $itemBody;

        $ch = curl_init($baseUrl . '/api/1/envelope/');
        curl_setopt_array($ch, [
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $envelope,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/x-sentry-envelope',
                'X-Sentry-Auth: Sentry sentry_key=test',
            ],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 5,
        ]);
        curl_exec($ch);
        curl_close($ch);
    }
}
