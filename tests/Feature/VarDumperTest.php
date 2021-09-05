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

    function test_dump_string()
    {
        dump('Hello', 'World');
        $this->assertTrue(true);
    }

    function test_dump_array()
    {
        dump(['a' => 1, 'b' => ['c' => 3]]);
        $this->assertTrue(true);
    }

    function test_dump_bool()
    {
        dump(true, false);
        $this->assertTrue(true);
    }

    function test_dump_int()
    {
        dump(1);
        $this->assertTrue(true);
    }

    function test_dump_object()
    {
        dump(ray());
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
