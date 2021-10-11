<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Modules\Monolog\Common as MonologActions;
use App\Modules\Ray\RayCommon as RayCommonActions;
use App\Modules\Ray\RayLaravel as RayLaravelActions;
use App\Modules\Sentry\Common as SentryActions;
use App\Modules\Smtp\Common as SmtpActions;
use App\Modules\VarDump\Common as VarDumpActions;
use App\Modules\Inspector\Common as InspectorActions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CallAction extends Controller
{
    use MonologActions,
        RayCommonActions, RayLaravelActions,
        SentryActions,
        SmtpActions,
        VarDumpActions,
        InspectorActions,
        WithFaker;

    private array $setUpMap = [
        'ray_logs:' => 'setUpRayLogger',
        'monolog:' => 'setUpSocketMonolog',
        'sentry:' => 'setupSentryLogger',
        'var_dump:' => 'setUpVarDumper',
        'inspector:' => 'setUpInspector'
    ];

    private array $replaceMap = [
        'ray_common:' => 'ray:',
        'ray_laravel:' => 'ray:',
    ];

    private array $actionsMap = [
        'ray_log:debug' => 'monologDebug',
        'ray_log:info' => 'monologInfo',
        'ray_log:warning' => 'monologWarning',
        'ray_log:error' => 'monologError',
        'ray_log:critical' => 'monologCritical',
        'ray_log:notice' => 'monologNotice',
        'ray_log:alert' => 'monologAlert',
        'ray_log:emergency' => 'monologEmergency',
        'ray_log:exception' => 'monologException',
    ];

    public function __invoke(Request $request)
    {
        $this->setUpFaker();

        $action = $request->action;

        foreach ($this->replaceMap as $from => $to) {
            $action = str_replace($from, $to, $action);
        }

        foreach ($this->setUpMap as $a => $method) {
            if (Str::startsWith($action, $a)) {
                call_user_func([$this, $method]);
                break;
            }
        }

        foreach ($this->actionsMap as $a => $method) {
            if ($action === $a) {
                call_user_func([$this, $method]);
                return 'ok';
            }
        }

        $method = Str::studly(Str::replace(':', '_', $action));

        if (method_exists($this, $method)) {
            call_user_func([$this, $method]);
            return 'ok';
        }

        abort(404);
    }
}
