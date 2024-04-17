<?php
declare(strict_types=1);

namespace App\Modules\Sentry;

use Sentry\SentrySdk;

trait Common
{
    public function setupSentryLogger()
    {
        ray()->disable();
        logger()->setDefaultDriver('null');
    }

    /** @test */
    function sentryReport()
    {
        try {
            \Illuminate\Support\Facades\Artisan::call('migrate:fresh', ['--force' => true]);
            \Illuminate\Support\Facades\Artisan::call('db:seed', ['--force' => true]);
            throw new \Exception('Something went wrong');
        } catch (\Throwable $e) {
            report($e);
        }
    }

    /** @test */
    function sentryEvent()
    {
        \Illuminate\Support\Facades\Artisan::call('migrate:fresh', ['--force' => true]);
        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--force' => true]);
        $currentHub = SentrySdk::getCurrentHub();
        $client = $currentHub->getClient();

        $currentHub->captureMessage('This is a test message from the Sentry bundle');
    }
}
