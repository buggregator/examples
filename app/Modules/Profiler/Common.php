<?php

declare(strict_types=1);

namespace App\Modules\Profiler;

use App\MyService\MyService;

trait Common
{
    public function setupProfiler(): void
    {
        ray()->disable();
        logger()->setDefaultDriver('null');
    }

    /** @test */
    function profilerReport(): void
    {
        \usleep(10_000);

        app(MyService::class)->call();
    }
}
