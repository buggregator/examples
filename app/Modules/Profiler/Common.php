<?php
declare(strict_types=1);

namespace App\Modules\Profiler;

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
    }
}
