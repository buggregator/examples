<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $buttonGroups = [
        'ray' => [
            'title' => 'Buggregator is compatible with spatie/ray package.',
            'description' => 'The Ray debug tool supports PHP, Ruby, JavaScript, TypeScript, NodeJS, Go and Bash applications. After installing one of the libraries, you can use the ray function to quickly dump stuff. Any variable(s) that you pass will be sent to the Buggregator.',
            'events' => [
                'common' => [
                    'NewScreen', 'NewScreenWithName', 'ClearAll', 'ClearScreen', 'Int', 'String',
                    'Array', 'Bool', 'Object', 'Colors', 'Sizes', 'Labels', 'Caller', 'Trace', 'Pause',
                    'Counter', 'CounterWithName', 'Limit', 'ClassName', 'Measure', 'Json', 'Xml', 'Carbon',
                    'File', 'Table', 'Image', 'Html', 'Text', 'Hide', 'Notify', 'Phpinfo', 'Exception', 'Markdown'
                ],
                'laravel' => [
                    'ShowQueries', 'CountQueries', 'ManuallyShowedQuery', 'ShowEvents', 'ShowJobs', 'ShowCache',
                    'ShowHttpClientRequests', 'HandlingModels', 'Mailable', 'ShowViews', 'Collections', 'StrString',
                    'Env',
                ],
                'logs' => [
                    'Debug', 'Info', 'Warning', 'Error', 'Critical', 'Notice', 'Alert', 'Emergency', 'Exception'
                ]
            ]
        ],
        'profiler' => [
            'title' => 'Buggregator can be used to profile application with xhprof.',
            'description' => 'Efficiently fine-tune your PHP application\'s performance by identifying performance bottlenecks.',
            'events' => [
                'common' => [
                    'Report',
                ],
            ],
        ],
        'sentry' => [
            'title' => 'Buggregator can bs used to receive Sentry reports from your application.',
            'description' => 'Directly send data to the server and debug your app with this lightweight alternative.',
            'events' => [
                'common' => [
                    'Report', 'Event'
                ],
            ],
        ],
        'monolog' => [
            'title' => 'Buggregator can receive logs from monolog/monolog package.',
            'description' => 'Analyze logs from your PHP application for improved insights and performance.',
            'events' => [
                'common' => [
                    'Debug',
                    'Info',
                    'Warning',
                    'Error',
                    'Critical',
                    'Notice',
                    'Alert',
                    'Emergency',
                    'Exception',
                ],
            ],
        ],
        'smtp' => [
            'title' => 'Buggregator also is an email testing tool that makes it super easy to install and configure a local email server (Like MailHog).',
            'description' => 'Test email functionality with ease during the development phase using Buggregator\'s SMTP server.',
            'events' => [
                'common' => [
                    'OrderShipped',
                    'WelcomeMail',
                ],
            ],
        ],
        'var_dump' => [
            'title' => 'Buggregator can receive dumps from symfony/var-dumper package.',
            'description' => 'A distinct space for debugging outputs, making data dump collection simpler. The dump() and dd() functions output its contents in the same browser window or console terminal as your own application. Sometimes mixing the real output with the debug output can be confusing. That’s why this Buggregator can be used to collect all the dumped data.',
            'events' => [
                'common' => [
                    'String',
                    'Array',
                    'Bool',
                    'Int',
                    'Object',
                    'Exception',
                ],
            ],
        ],
        'inspector' => [
            'title' => 'Buggregator can be used to receive Inspector reports from your application.',
            'description' => 'A handy feature for local development, ensuring swift issue identification and resolution.',
            'events' => [
                'common' => [
                    'Request',
                    'Command',
                ],
            ],
        ],
    ];

    return view('welcome', compact('buttonGroups'));
});


Route::post('/_profiler', \App\Http\Controllers\CallAction::class)->middleware(
    \App\Http\Middleware\ProfilerMiddleware::class,
);

Route::post('/', \App\Http\Controllers\CallAction::class);

Route::middleware(\Inspector\Laravel\Middleware\WebRequestMonitoring::class)
    ->get('/inspector', function () {
        \Illuminate\Support\Facades\Artisan::call('migrate:fresh');
        \Illuminate\Support\Facades\Artisan::call('db:seed');

        $users = \App\Models\User::all();

        return view('inspector', compact('users'));
    });
