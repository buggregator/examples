<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Modules\Monolog\Common as MonologActions;
use App\Modules\Ray\RayCommon as RayCommonActions;
use App\Modules\Ray\RayLaravel as RayLaravelActions;
use App\Modules\Sentry\Common as SentryActions;
use App\Modules\Profiler\Common as ProfilerActions;
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
        InspectorActions,
        ProfilerActions,
        WithFaker;

    private array $setUpMap = [
        'ray_logs:' => 'setUpRayLogger',
        'profiler:' => 'setupProfiler',
        'sentry:' => 'setupSentryLogger',
        'monolog:' => 'setUpSocketMonolog',
        'var_dump:' => 'setUpVarDumper',
        'inspector:' => 'setUpInspector',
    ];

    private array $replaceMap = [
        'ray_common:' => 'ray:',
        'ray_laravel:' => 'ray:',
    ];

    private array $actionsMap = [
        'ray_logs:debug' => 'monologDebug',
        'ray_logs:info' => 'monologInfo',
        'ray_logs:warning' => 'monologWarning',
        'ray_logs:error' => 'monologError',
        'ray_logs:critical' => 'monologCritical',
        'ray_logs:notice' => 'monologNotice',
        'ray_logs:alert' => 'monologAlert',
        'ray_logs:emergency' => 'monologEmergency',
        'ray_logs:exception' => 'monologException',
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
