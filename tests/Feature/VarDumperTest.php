<?php
declare(strict_types=1);

namespace Tests\Feature;

use Symfony\Component\VarDumper\VarDumper;
use Tests\TestCase;

class VarDumperTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        ray()->disable();

        VarDumper::setHandler();
        $_SERVER['VAR_DUMPER_FORMAT'] = 'server';
    }

    function test_dump()
    {
        dump('Hello', 'World');

        dump(['an array']);

        dump(true, false);

        dump(ray());

        dump(['a' => 1, 'b' => ['c' => 3]]);

        $this->assertTrue(true);
    }

    function test_exception()
    {
        try {
            throw new \Exception('Something went wrong');
        } catch(\Exception $e) {
            dump($e);
        }

        $this->assertTrue(true);
    }
}
