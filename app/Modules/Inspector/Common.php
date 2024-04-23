<?php
declare(strict_types=1);

namespace App\Modules\Inspector;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

trait Common
{
    public function setUpInspector(): void
    {
        ray()->disable();
    }

    /** @test */
    public function inspectorRequest(): void
    {
        $request = Request::create('/inspector');

        Route::dispatch($request);
    }

    /** @test */
    public function inspectorCommand(): void
    {
        Artisan::call('inspector:test');
    }
}
