<?php
declare(strict_types=1);

namespace App\Modules\Sentry;

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
}
