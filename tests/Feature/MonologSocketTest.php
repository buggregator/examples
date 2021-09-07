<?php
declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class MonologSocketTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        logger()->setDefaultDriver('socket');

        ray()->disable();
    }

    function test_debug()
    {
        logger()->debug('Hello debug', [
            'foo' => 'bar'
        ]);

        $this->assertTrue(true);
    }

    function test_info()
    {
        logger()->info('Hello info', [
            'foo' => 'bar'
        ]);

        $this->assertTrue(true);
    }

    function test_warning()
    {
        logger()->warning('Hello warning', [
            'foo' => 'bar'
        ]);

        $this->assertTrue(true);
    }

    function test_error()
    {
        logger()->error('Hello error', [
            'foo' => 'bar'
        ]);

        $this->assertTrue(true);
    }

    function test_critical()
    {
        logger()->critical('Hello critical', [
            'foo' => 'bar'
        ]);

        $this->assertTrue(true);
    }

    function test_notice()
    {
        logger()->notice('Hello notice', [
            'foo' => 'bar'
        ]);

        $this->assertTrue(true);
    }

    function test_alert()
    {
        logger()->alert('Hello alert', [
            'foo' => 'bar'
        ]);

        $this->assertTrue(true);
    }

    function test_emergency()
    {
        logger()->emergency('Hello emergency', [
            'foo' => 'bar'
        ]);

        $this->assertTrue(true);
    }

    function test_exception()
    {
        try {
            throw new \Exception('Something went wrong');
        } catch (\Throwable $e) {
            logger()->error($e);
        }

        $this->assertTrue(true);
    }
}
