<?php
declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class SentryTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        ray()->disable();
        logger()->setDefaultDriver('null');
    }

    function test_report()
    {
        try {
            throw new \Exception('Something went wrong');
        } catch (\Throwable $e) {
            report($e);
        }

        $this->assertTrue(true);
    }
}
