<?php
declare(strict_types=1);

namespace Tests\Feature;

use App\Jobs\TestJob;
use App\Mail\OrderShipped;
use App\Models\User;
use Illuminate\Database\Events\ModelsPruned;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Tests\TestCase;

class RayLaravelTest extends TestCase
{
    use DatabaseMigrations;

    function test_show_queries()
    {
        ray()->showQueries();
        User::firstWhere('email', 'john@example.com');

        $this->assertTrue(true);
    }

    function test_count_queries()
    {
        ray()->countQueries(function () {
            User::all();
            User::all();
        });

        $this->assertTrue(true);
    }

    function test_manually_showed_query()
    {
        User::query()
            ->where('first_name', 'John')
            ->ray()
            ->where('last_name', 'Doe')
            ->ray()
            ->first();

        $this->assertTrue(true);
    }

    function test_show_events()
    {
        ray()->showEvents();
        event(new ModelsPruned(new User(), 100));

        $this->assertTrue(true);
    }

    function test_show_jobs()
    {
        ray()->showJobs();
        dispatch(new TestJob('my-test-job'));

        $this->assertTrue(true);
    }

    function test_show_cache()
    {
        ray()->showCache();

        Cache::put('my-key', ['a' => 1]);

        Cache::get('my-key');

        Cache::get('another-key');

        $this->assertTrue(true);
    }

    function test_show_http_client_requests()
    {
        ray()->showHttpClientRequests();
        Http::get('https://jsonplaceholder.typicode.com/posts/1');

        $this->assertTrue(true);
    }

    function test_handling_models()
    {
        ray()->model(
            User::firstWhere('email', 'john@example.com')
        );

        ray()->model(new User([
            'username' => 'john',
            'email' => 'john@example.com'
        ]));

        $this->assertTrue(true);
    }

    function test_mailable()
    {
        $mail = new OrderShipped();
        $mail->from('from@site.com', 'Test from');
        $mail->cc('cc@site.com');
        $mail->bcc('cc@site.com');
        $mail->to('to@site.com', 'Test to');

        ray()->mailable($mail);

        $this->assertTrue(true);
    }

    function test_show_views()
    {
        ray()->showViews();

        // typically you'll do this in a controller
        view('welcome', ['name' => 'John Doe'])->render();

        $this->assertTrue(true);
    }

    function test_collections()
    {
        collect(['a', 'b', 'c'])
            ->ray('original collection') // displays the original collection
            ->map(fn(string $letter) => strtoupper($letter))
            ->ray('uppercased collection'); // displays the modified collection

        $this->assertTrue(true);
    }

    function test_string()
    {
        Str::of('Lorem')
            ->append(' Ipsum')
            ->ray()
            ->append(' Dolor Sit Amen');

        $this->assertTrue(true);
    }

    function test_env()
    {
        ray()->env();

        $this->assertTrue(true);
    }

    function test_response()
    {
        $this
            ->get('/')
            ->ray()
            ->assertSuccessful();

        $this->assertTrue(true);
    }
}
