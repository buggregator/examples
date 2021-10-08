<?php
declare(strict_types=1);

namespace Tests\Feature;

use App\Modules\Sentry\Common;
use Tests\TestCase;

class SentryTest extends TestCase
{
    use Common;

    protected function setUp(): void
    {
        parent::setUp();

        $this->setupSentryLogger();
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->assertTrue(true);
    }
}
