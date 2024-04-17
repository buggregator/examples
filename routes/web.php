<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $buttonGroups = [
        'ray' => [
            'title' => 'Buggregator is compatible with spatie/ray package.',
            'description' => 'The Ray debug tool supports PHP, Ruby, JavaScript, TypeScript, NodeJS, Go and Bash applications. After installing one of the libraries, you can use the ray function to quickly dump stuff. Any variable(s) that you pass will be sent to the Buggregator.',
            'events' => [
                'common' => [
                    'NewScreen',
                    'NewScreenWithName',
                    'ClearAll',
                    'ClearScreen',
                    'Int',
                    'String',
                    'Array',
                    'Bool',
                    'Object',
                    'Colors',
                    'Sizes',
                    'Labels',
                    'Caller',
                    'Trace',
                    'Pause',
                    'Counter',
                    'CounterWithName',
                    'Limit',
                    'ClassName',
                    'Measure',
                    'Json',
                    'Xml',
                    'Carbon',
                    'File',
                    'Table',
                    'Image',
                    'Html',
                    'Text',
                    'Hide',
                    'Notify',
                    'Phpinfo',
                    'Exception',
                    'Markdown',
                ],
                'laravel' => [
                    'ShowQueries',
                    'CountQueries',
                    'ManuallyShowedQuery',
                    'ShowEvents',
                    'ShowJobs',
                    'ShowCache',
                    'ShowHttpClientRequests',
                    'HandlingModels',
                    'Mailable',
                    'ShowViews',
                    'Collections',
                    'StrString',
                    'Env',
                ],
                'logs' => [
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
            'docs' => 'https://docs.buggregator.dev/config/ray.html',
        ],
        'profiler' => [
            'title' => 'PHP Application profiler',
            'description' => 'Pinpoint performance bottlenecks in your PHP applications. This lightweight profiler provides essential insights to optimize your code for better efficiency and speed.',
            'events' => [
                'common' => [
                    'Report',
                ],
            ],
            'docs' => 'https://docs.buggregator.dev/config/xhprof.html',
        ],
        'sentry' => [
            'title' => 'Exception Handling with Sentry Integration',
            'description' => 'Use Buggregator as a local alternative to Sentry for catching exceptions. It helps you identify and resolve errors efficiently before they affect your production environment.',
            'events' => [
                'common' => [
                    'Report',
                    'Event',
                ],
            ],
            'docs' => 'https://docs.buggregator.dev/config/sentry.html',
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
            'docs' => 'https://docs.buggregator.dev/config/monolog.html',
        ],
        'smtp' => [
            'title' => 'SMTP Email Testing',
            'description' => 'Test email functionalities within your applications without relying on external email servers. Simulate receiving emails to verify that your application handles email operations correctly.',
            'events' => [
                'common' => [
                    'OrderShipped',
                    'WelcomeMail',
                ],
            ],
            'docs' => 'https://docs.buggregator.dev/config/smtp.html',
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
            'docs' => 'https://docs.buggregator.dev/config/var-dumper.html',
        ],
        'inspector' => [
            'title' => 'It can be used to receive Inspector reports from your application.',
            'description' => 'A handy feature for local development, ensuring swift issue identification and resolution.',
            'events' => [
                'common' => [
                    'Request',
                    'Command',
                ],
            ],
            'docs' => 'https://docs.buggregator.dev/config/inspector.html',
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
        \Illuminate\Support\Facades\Artisan::call('migrate:fresh', ['--force' => true]);
        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--force' => true]);

        $users = \App\Models\User::all();

        return view('inspector', compact('users'));
    });
