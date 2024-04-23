<?php

declare(strict_types=1);

namespace App\Modules\Ray;

use App\Jobs\TestJob;
use App\Mail\OrderShipped;
use App\Models\User;
use App\RandomPhraseGenerator;
use Illuminate\Database\Events\ModelsPruned;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

trait RayLaravel
{
    /** @test */
    function rayShowQueries(): void
    {
        ray()->showQueries();
        User::firstWhere('email', 'john@example.com');
    }

    /** @test */
    function rayCountQueries(): void
    {
        ray()->countQueries(function () {
            User::all();
            User::all();
        });
    }

    /** @test */
    function rayManuallyShowedQuery(): void
    {
        User::query()
            ->where('first_name', 'John')
            ->ray()
            ->where('last_name', 'Doe')
            ->ray()
            ->first();
    }

    /** @test */
    function rayShowEvents(): void
    {
        ray()->showEvents();
        event(new ModelsPruned(new User(), 100));
    }

    /** @test */
    function rayShowJobs(): void
    {
        ray()->showJobs();
        dispatch(new TestJob('my-test-job'));
    }

    /** @test */
    function rayShowCache(): void
    {
        ray()->showCache();

        Cache::put('my-key', ['a' => 1]);

        Cache::get('my-key');

        Cache::get('another-key');
    }

    /** @test */
    function rayShowHttpClientRequests(): void
    {
        ray()->showHttpClientRequests();
        Http::get('https://ya.ru', [
            'heloo' => 'world',
        ]);
    }

    /** @test */
    function rayHandlingModels(): void
    {
        ray()->model(
            User::firstWhere('email', 'john@example.com'),
        );

        ray()->model(new User([
            'username' => 'john',
            'email' => 'john@example.com',
        ]));
    }

    /** @test */
    function rayMailable(RandomPhraseGenerator $generator): void
    {
        $mail = new OrderShipped($generator->generateEmailSubject());
        $mail->from($this->faker->email, 'Test from');
        $mail->cc($this->faker->email);
        $mail->bcc($this->faker->email);
        $mail->to($this->faker->email, 'Test to');

        ray()->mailable($mail);
    }

    /** @test */
    function rayShowViews(RandomPhraseGenerator $generator): void
    {
        ray()->showViews();

        view('inspector', ['phrase' => $generator->generate('Buggregator')])->render();
    }

    /** @test */
    function rayCollections(): void
    {
        collect(['a', 'b', 'c'])
            ->ray('original collection') // displays the original collection
            ->map(fn(string $letter) => strtoupper($letter))
            ->ray('uppercased collection'); // displays the modified collection
    }

    /** @test */
    function rayStrString(): void
    {
        Str::of('Lorem')
            ->append(' Ipsum')
            ->ray()
            ->append(' Dolor Sit Amen');
    }

    /** @test */
    function rayEnv(): void
    {
        ray()->env();
    }
}
