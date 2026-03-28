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
}
