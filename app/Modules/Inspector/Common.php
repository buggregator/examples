<?php
declare(strict_types=1);

namespace App\Modules\Inspector;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

trait Common
{
    public function setUpInspector()
    {
        ray()->disable();
    }

    /** @test */
    public function inspectorRequest()
    {
        $request = Request::create('/inspector');

        Route::dispatch($request);
    }

    /** @test */
    public function inspectorCommand()
    {
        Artisan::call('inspector:test');
    }
}
