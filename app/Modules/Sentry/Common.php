<?php

declare(strict_types=1);

namespace App\Modules\Sentry;

use App\RandomPhraseGenerator;
use Sentry\SentrySdk;

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
            \Illuminate\Support\Facades\Artisan::call('migrate:fresh', ['--force' => true]);
            \Illuminate\Support\Facades\Artisan::call('db:seed', ['--force' => true]);
            throw new \Exception($generator->generateException('Buggregator'));
        } catch (\Throwable $e) {
            report($e);
        }
    }

    /** @test */
    function sentryEvent(RandomPhraseGenerator $generator): void
    {
        \Illuminate\Support\Facades\Artisan::call('migrate:fresh', ['--force' => true]);
        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--force' => true]);
        $currentHub = SentrySdk::getCurrentHub();
        $client = $currentHub->getClient();

        $currentHub->captureMessage($generator->generateException('Buggregator'));
    }
}
