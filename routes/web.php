<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(\Inspector\Laravel\Middleware\WebRequestMonitoring::class)
    ->get('/inspector', function () {
        //\App\Models\User::all();

        return view('welcome');
    });
