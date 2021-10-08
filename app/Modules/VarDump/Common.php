<?php
declare(strict_types=1);

namespace App\Modules\VarDump;

use Symfony\Component\VarDumper\VarDumper;

trait Common
{
    public function setUpVarDumper()
    {
        ray()->disable();

        VarDumper::setHandler();
        $_SERVER['VAR_DUMPER_SERVER'] = env('VAR_DUMPER_SERVER', '127.0.0.1:9912');
        $_SERVER['VAR_DUMPER_FORMAT'] = 'server';
    }

    /** @test */
    function varDumpString()
    {
        dump('Hello', 'World');
    }

    /** @test */
    function varDumpArray()
    {
        dump(['a' => 1, 'b' => ['c' => 3]]);
    }

    /** @test */
    function varDumpBool()
    {
        dump(true, false);
    }

    /** @test */
    function varDumpInt()
    {
        dump(1);
    }

    /** @test */
    function varDumpObject()
    {
        dump(ray());
    }

    /** @test */
    function varDumpException()
    {
        try {
            throw new \Exception('Something went wrong');
        } catch (\Exception $e) {
            dump($e);
        }
    }
}
