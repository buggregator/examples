<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use SpiralPackages\Profiler\Driver\DriverInterface;
use SpiralPackages\Profiler\DriverFactory;
use SpiralPackages\Profiler\Storage\StorageInterface;
use SpiralPackages\Profiler\Storage\WebStorage;
use Symfony\Component\HttpClient\NativeHttpClient;

class ProfilerServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(StorageInterface::class, function () {
            return new WebStorage(
                new NativeHttpClient(),
                config('services.profiler.endpoint'),
            );
        });

        $this->app->bind(DriverInterface::class, function () {
            return DriverFactory::detect();
        });
    }
}