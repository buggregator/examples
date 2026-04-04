<?php

declare(strict_types=1);

namespace App\Modules\HttpProxy;

use App\RandomPhraseGenerator;
use Illuminate\Support\Facades\Http;

trait Common
{
    public function setUpHttpProxy(): void
    {
        ray()->disable();
        logger()->setDefaultDriver('null');
    }

    /** @test */
    function httpProxyGet(RandomPhraseGenerator $generator): void
    {
        $response = $this->proxyClient()->get('https://httpbin.org/get', [
            'message' => $generator->generate('Buggregator'),
            'timestamp' => now()->toIso8601String(),
        ]);
    }

    /** @test */
    function httpProxyPost(RandomPhraseGenerator $generator): void
    {
        $response = $this->proxyClient()->post('https://httpbin.org/post', [
            'event' => 'order.created',
            'data' => [
                'order_id' => random_int(1000, 9999),
                'amount' => round(random_int(999, 49999) / 100, 2),
                'currency' => 'USD',
                'customer' => $this->faker->email,
            ],
            'message' => $generator->generate('Webhook'),
        ]);
    }

    /** @test */
    function httpProxyPut(RandomPhraseGenerator $generator): void
    {
        $id = random_int(1, 100);
        $response = $this->proxyClient()->put("https://jsonplaceholder.typicode.com/posts/{$id}", [
            'id' => $id,
            'title' => $generator->generate('Buggregator'),
            'body' => $generator->generate('Updated post'),
            'userId' => random_int(1, 10),
        ]);
    }

    /** @test */
    function httpProxyDelete(): void
    {
        $id = random_int(1, 100);
        $response = $this->proxyClient()->delete("https://jsonplaceholder.typicode.com/posts/{$id}");
    }

    /** @test */
    function httpProxyHeaders(RandomPhraseGenerator $generator): void
    {
        $response = $this->proxyClient()
            ->withHeaders([
                'X-Custom-Header' => $generator->generate('Buggregator'),
                'X-Request-Id' => (string) \Illuminate\Support\Str::uuid(),
                'Authorization' => 'Bearer test-token-' . bin2hex(random_bytes(16)),
            ])
            ->get('https://httpbin.org/headers');
    }

    /** @test */
    function httpProxyStatusCodes(): void
    {
        $codes = [200, 201, 301, 400, 404, 500];
        $code = $codes[array_rand($codes)];
        $response = $this->proxyClient()->get("https://httpbin.org/status/{$code}");
    }

    /** @test */
    function httpProxyDelay(): void
    {
        $response = $this->proxyClient()
            ->timeout(10)
            ->get('https://httpbin.org/delay/2');
    }

    /** @test */
    function httpProxyJsonApi(RandomPhraseGenerator $generator): void
    {
        // Create a post
        $response = $this->proxyClient()->post('https://jsonplaceholder.typicode.com/posts', [
            'title' => $generator->generate('Buggregator'),
            'body' => $generator->generate('API test'),
            'userId' => random_int(1, 10),
        ]);

        // Then fetch it
        $this->proxyClient()->get('https://jsonplaceholder.typicode.com/posts/1');

        // And its comments
        $this->proxyClient()->get('https://jsonplaceholder.typicode.com/posts/1/comments');
    }

    private function proxyClient(): \Illuminate\Http\Client\PendingRequest
    {
        return Http::withOptions([
            'proxy' => config('services.buggregator_proxy.url', 'http://buggregator:8080'),
            'verify' => false,
        ]);
    }
}
