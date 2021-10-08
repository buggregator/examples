<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $buttonGroups = [
        'ray_common' => [
            'NewScreen', 'NewScreenWithName', 'ClearAll', 'ClearScreen', 'Int', 'String',
            'Array', 'Bool', 'Object', 'Colors', 'Sizes', 'Labels', 'Caller', 'Trace', 'Pause',
            'Counter', 'CounterWithName', 'Limit', 'ClassName', 'Measure', 'Json', 'Xml', 'Carbon',
            'File', 'Table', 'Image', 'Html', 'Text', 'Hide', 'Notify', 'Phpinfo', 'Exception', 'Markdown'
        ],
        'ray_laravel' => [
            'ShowQueries', 'CountQueries', 'ManuallyShowedQuery', 'ShowEvents', 'ShowJobs', 'ShowCache',
            'ShowHttpClientRequests', 'HandlingModels', 'Mailable', 'ShowViews', 'Collections', 'StrString',
            'Env'
        ],
        'ray_log' => [
            'Debug', 'Info', 'Warning', 'Error', 'Critical', 'Notice', 'Alert', 'Emergency', 'Exception'
        ],
        'monolog' => [
            'Debug', 'Info', 'Warning', 'Error', 'Critical', 'Notice', 'Alert', 'Emergency', 'Exception'
        ],
        'sentry' => [
            'Report'
        ],
        'smtp' => [
            'OrderShipped', 'WelcomeMail'
        ],
        'var_dump' => [
            'String', 'Array', 'Bool', 'Int', 'Object', 'Exception'
        ],
        'inspector' => [
            'Request', 'Command'
        ]
    ];

    return view('welcome', compact('buttonGroups'));
});

Route::post('/', \App\Http\Controllers\CallAction::class);

Route::middleware(\Inspector\Laravel\Middleware\WebRequestMonitoring::class)
    ->get('/inspector', function () {
        \Illuminate\Support\Facades\Artisan::call('migrate:fresh');
        \Illuminate\Support\Facades\Artisan::call('db:seed');

        \App\Models\User::all();

        return view('inspector');
    });
