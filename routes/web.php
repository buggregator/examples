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
                ],
                'logs' => [
                    'Env', 'Debug', 'Info', 'Warning', 'Error', 'Critical', 'Notice', 'Alert', 'Emergency', 'Exception'
                ]
            ]
        ],
        'monolog' => [
            'title' => 'Buggregator can receive logs from monolog/monolog package.',
            'description' => 'It can receive logs via \Monolog\Handler\SocketHandler handler.',
            'events' => [
                'common' => [
                    'Debug', 'Info', 'Warning', 'Error', 'Critical', 'Notice', 'Alert', 'Emergency', 'Exception'
                ]
            ]
        ],
        'sentry' => [
            'title' => 'Buggregator can be used to receive Sentry reports from your application.',
            'description' => 'Buggregator is a lightweight alternative for local development. Just configure Sentry DSN to send data to Buggregator.',
            'events' => [
                'common' => [
                    'Report'
                ]
            ]
        ],
        'smtp' => [
            'title' => 'Buggregator also is an email testing tool that makes it super easy to install and configure a local email server (Like MailHog).',
            'description' => 'Buggregator sets up a fake SMTP server and you can configure your preferred web applications to use Buggregator’s SMTP server to send and receive emails. For instance, you can configure a local WordPress site to use Buggregator for email deliveries.',
            'events' => [
                'common' => [
                    'OrderShipped', 'WelcomeMail'
                ]
            ]
        ],
        'var_dump' => [
            'title' => 'Buggregator can receive dumps from symfony/var-dumper package.',
            'description' => 'The dump() and dd() functions output its contents in the same browser window or console terminal as your own application. Sometimes mixing the real output with the debug output can be confusing. That’s why this Buggregator can be used to collect all the dumped data.',
            'events' => [
                'common' => [
                    'String', 'Array', 'Bool', 'Int', 'Object', 'Exception'
                ]
            ]
        ],
        'inspector' => [
            'title' => 'Buggregator can be used to receive Inspector reports from your application.',
            'events' => [
                'common' => [
                    'Request', 'Command'
                ]
            ]
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
