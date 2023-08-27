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
            throw new \Exception('Something went wrong');
        } catch (\Throwable $e) {
            report($e);
        }
    }

    /** @test */
    function sentryEvent()
    {
        $currentHub = SentrySdk::getCurrentHub();
        $client = $currentHub->getClient();

        $eventId = $currentHub->captureMessage('This is a test message from the Sentry bundle');
    }
}
