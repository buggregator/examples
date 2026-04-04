<?php

use App\Http\Controllers\CallAction;
use App\Http\Middleware\ProfilerMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $buttonGroups = [
        'profiler' => [
            'title' => 'Profiler',
            'events' => [
                'common' => [
                    'Report',
                ],
            ],
        ],
        'sentry' => [
            'title' => 'Sentry',
            'events' => [
                'common' => [
                    'Report',
                    'Event',
                    'ModelNotFound',
                    'Validation',
                    'WithContext',
                    'NestedExceptions',
                    'DatabaseError',
                    'TypeError',
                    'Trace',
                    'TraceWithError',
                    'Logs',
                ],
            ],
        ],
        'monolog' => [
            'title' => 'Monolog',
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
            'title' => 'SMTP',
            'events' => [
                'common' => [
                    'OrderShipped',
                    'WelcomeMail',
                    'PasswordReset',
                    'WeeklyReport',
                    'Invoice',
                ],
            ],
        ],
        'var_dump' => [
            'title' => 'Var-dumper',
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
            'title' => 'Inspector',
            'events' => [
                'common' => [
                    'Request',
                    'Command',
                    'Queries',
                    'Relationships',
                    'Transaction',
                    'SlowQuery',
                ],
            ],
        ],
        'sms' => [
            'title' => 'SMS Gateway',
            'events' => [
                'common' => [
                    'Twilio',
                    'Vonage',
                    'Plivo',
                    'Sinch',
                    'Infobip',
                    'Messagebird',
                    'Telnyx',
                    'Bandwidth',
                    'Brevo',
                    'Termii',
                    'Clickatell',
                    'Messagemedia',
                    'Lox24',
                    'Unifonic',
                    'Yunpian',
                    'Octopush',
                    'Gatewayapi',
                    'Sevenio',
                    'Smsfactor',
                    'Smsru',
                    'Smsaero',
                    'Smsc',
                    'Devino',
                    'Iqsms',
                    'Mts',
                    'Beeline',
                    'Megafon',
                    'TwilioMissingFields',
                    'VonageMissingAuth',
                    'Generic',
                ],
            ],
        ],
        'http' => [
            'title' => 'Http dumps',
            'description' => '-',
            'events' => [
                'common' => [
                    'get',
                    'post',
                    'put',
                    'patch',
                    'delete',
                ],
            ],
        ],
        'http_proxy' => [
            'title' => 'HTTP Proxy',
            'events' => [
                'common' => [
                    'Get',
                    'Post',
                    'Put',
                    'Delete',
                    'Headers',
                    'StatusCodes',
                    'Delay',
                    'JsonApi',
                ],
            ],
        ],
        'ray' => [
            'title' => 'Ray',
            'events' => [
                'common' => [
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
        ],
    ];

    return view('welcome', compact('buttonGroups'));
});
Route::post('/_profiler', CallAction::class)->middleware(
    ProfilerMiddleware::class,
);

Route::post('/', CallAction::class);

Route::post('/example/call', CallAction::class);
Route::post('/example/call/profiler', CallAction::class)->middleware(
    ProfilerMiddleware::class,
);

Route::middleware(\Inspector\Laravel\Middleware\WebRequestMonitoring::class)
    ->get('/inspector', function () {
        \Illuminate\Support\Facades\Artisan::call('migrate:fresh', ['--force' => true]);
        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--force' => true]);

        $users = \App\Models\User::all();

        return view('inspector', compact('users'));
    });
