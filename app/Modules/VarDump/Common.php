<?php

declare(strict_types=1);

namespace App\Modules\VarDump;

use App\RandomPhraseGenerator;
use Symfony\Component\VarDumper\VarDumper;

trait Common
{
    public function setUpVarDumper(): void
    {
        ray()->disable();

        VarDumper::setHandler();
        $_SERVER['VAR_DUMPER_SERVER'] = env('VAR_DUMPER_SERVER', '127.0.0.1:9912');
        $_SERVER['VAR_DUMPER_FORMAT'] = 'server';
    }

    /** @test */
    function varDumpString(RandomPhraseGenerator $generator): void
    {
        dump('Here is a random phrase', $generator->generate('Buggregator'));
    }

    /** @test */
    function varDumpArray(): void
    {
        dump(['a' => 4, 'b' => ['c' => 8, 'd' => 15], 'e' => [16, 23, 42]]);
    }

    /** @test */
    function varDumpBool(): void
    {
        dump(true, false);
    }

    /** @test */
    function varDumpInt(): void
    {
        dump(4, 8, 15, 16, 23, 42);
    }

    /** @test */
    function varDumpObject(RandomPhraseGenerator $generator): void
    {
        $object = new \stdClass();
        $object->name = 'Buggregator';
        $object->funnyFact = $generator->generate('Buggregator');

        dump($object);
        dump(ray());
    }

    /** @test */
    function varDumpException(RandomPhraseGenerator $generator): void
    {
        try {
            throw new \Exception($generator->generateException('Buggregator'));
        } catch (\Exception $e) {
            dump($e);
        }
    }
}
