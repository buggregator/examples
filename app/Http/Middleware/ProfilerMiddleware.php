<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use SpiralPackages\Profiler\Profiler;

class ProfilerMiddleware
{
    public function __construct(
        private Application $app,
    ) {
    }

    public function handle(Request $request, \Closure $next)
    {
        $profiler = $this->app->make(Profiler::class, [
            'appName' => 'Simple app',
        ]);

        $profiler->start();


        try {
            return $next($request);
        } finally {
            $profiler->end([
                'uri' => (string)$request->getUri(),
            ]);
        }
    }
}