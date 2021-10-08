<?php
declare(strict_types=1);

namespace App\Modules\Monolog;

trait Common
{
    public function setUpSocketMonolog()
    {
        logger()->setDefaultDriver('socket');
        ray()->disable();
    }

    public function setUpSlackMonolog()
    {
        logger()->setDefaultDriver('slack');
        ray()->disable();
    }

    public function setUpRayLogger()
    {
        logger()->setDefaultDriver('null');
    }

    /**
     * @test
     */
    function monologDebug()
    {
        logger()->debug('Hello debug', [
            'foo' => 'bar'
        ]);
    }

    /** @test */
    function monologInfo()
    {
        logger()->info('Hello info', [
            'foo' => 'bar'
        ]);
    }

    /** @test */
    function monologWarning()
    {
        logger()->warning('Hello warning', [
            'foo' => 'bar'
        ]);
    }

    /** @test */
    function monologError()
    {
        logger()->error('Hello error', [
            'foo' => 'bar'
        ]);
    }

    /** @test */
    function monologCritical()
    {
        logger()->critical('Hello critical', [
            'foo' => 'bar'
        ]);
    }

    /** @test */
    function monologNotice()
    {
        logger()->notice('Hello notice', [
            'foo' => 'bar'
        ]);
    }

    /** @test */
    function monologAlert()
    {
        logger()->alert('Hello alert', [
            'foo' => 'bar'
        ]);
    }

    /** @test */
    function monologEmergency()
    {
        logger()->emergency('Hello emergency', [
            'foo' => 'bar'
        ]);
    }

    /** @test */
    function monologException()
    {
        try {
            throw new \Exception('Something went wrong');
        } catch (\Throwable $e) {
            logger()->error($e);
        }
    }
}
