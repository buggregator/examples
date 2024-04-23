<?php
declare(strict_types=1);

namespace App\Modules\Monolog;

use App\RandomPhraseGenerator;

trait Common
{
    public function setUpSocketMonolog(): void
    {
        logger()->setDefaultDriver('socket');
        ray()->disable();
    }

    public function setUpSlackMonolog(): void
    {
        logger()->setDefaultDriver('slack');
        ray()->disable();
    }

    public function setUpRayLogger(): void
    {
        logger()->setDefaultDriver('null');
    }

    /**
     * @test
     */
    function monologDebug(RandomPhraseGenerator $generator): void
    {
        logger()->debug($generator->generate('Buggregator'), [
            'foo' => 'bar'
        ]);
    }

    /** @test */
    function monologInfo(RandomPhraseGenerator $generator): void
    {
        logger()->info($generator->generate('Buggregator'), [
            'foo' => 'bar'
        ]);
    }

    /** @test */
    function monologWarning(RandomPhraseGenerator $generator): void
    {
        logger()->warning($generator->generate('Buggregator'), [
            'foo' => 'bar'
        ]);
    }

    /** @test */
    function monologError(RandomPhraseGenerator $generator): void
    {
        logger()->error($generator->generate('Buggregator'), [
            'foo' => 'bar'
        ]);
    }

    /** @test */
    function monologCritical(RandomPhraseGenerator $generator): void
    {
        logger()->critical($generator->generate('Buggregator'), [
            'foo' => 'bar'
        ]);
    }

    /** @test */
    function monologNotice(RandomPhraseGenerator $generator): void
    {
        logger()->notice($generator->generate('Buggregator'), [
            'foo' => 'bar'
        ]);
    }

    /** @test */
    function monologAlert(RandomPhraseGenerator $generator): void
    {
        logger()->alert($generator->generate('Buggregator'), [
            'foo' => 'bar'
        ]);
    }

    /** @test */
    function monologEmergency(RandomPhraseGenerator $generator): void
    {
        logger()->emergency($generator->generate('Buggregator'), [
            'foo' => 'bar'
        ]);
    }

    /** @test */
    function monologException(RandomPhraseGenerator $generator): void
    {
        try {
            throw new \Exception($generator->generateException('Buggregator'));
        } catch (\Throwable $e) {
            logger()->error($e);
        }
    }
}
