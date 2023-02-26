<?php
declare(strict_types=1);

namespace App\Modules\Profiler;

trait Common
{
    public function setupProfiler()
    {
        ray()->disable();
        logger()->setDefaultDriver('null');
    }

    /** @test */
    function profilerReport()
    {
    }
}
