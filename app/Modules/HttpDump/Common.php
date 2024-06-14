<?php

declare(strict_types=1);

namespace App\Modules\HttpDump;

use App\RandomPhraseGenerator;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

trait Common
{
    protected string $url;
    private PendingRequest $httpClient;

    public function setUpHttp(): void
    {
        $this->url = config('services.http_dump.endpoint');

        $domain = parse_url($this->url, PHP_URL_HOST);
        $this->httpClient = Http::withHeaders([
            'X-Header' => 'Buggregator',
        ])
            ->withCookies([
                'some-token' => 'some-value',
            ], $domain)
            ->withUserAgent('Buggregator');
    }

    /** @test */
    public function httpGet(RandomPhraseGenerator $generator): void
    {
        $this->httpClient->get(\sprintf('%s/some-path', $this->url), [
            'message' => $generator->generate('Buggregator'),
        ]);
    }

    /** @test */
    public function httpPost(RandomPhraseGenerator $generator): void
    {
        $this->httpClient
            ->attach([
                ['file', fopen(app()->resourcePath('images/logo.svg'), 'r')],
                ['message', $generator->generate('Buggregator'),],
            ])
            ->post(\sprintf('%s/some-path', $this->url));
    }

    /** @test */
    public function httpPut(RandomPhraseGenerator $generator): void
    {
        $this->httpClient->put(\sprintf('%s/some-path', $this->url), [
            'message' => $generator->generate('Buggregator'),
        ]);
    }

    /** @test */
    public function httpPath(RandomPhraseGenerator $generator): void
    {
        $this->httpClient->patch(\sprintf('%s/some-path', $this->url), [
            'message' => $generator->generate('Buggregator'),
        ]);
    }

    /** @test */
    public function httpDelete(RandomPhraseGenerator $generator): void
    {
        $this->httpClient->delete(\sprintf('%s/some-path', $this->url), [
            'message' => $generator->generate('Buggregator'),
        ]);
    }
}
