<?php
declare(strict_types=1);

namespace Tests\Feature;

use App\Modules\Monolog\Common;
use Tests\TestCase;

class MonologSocketTest extends TestCase
{
    use Common;

    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpSocketMonolog();
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->assertTrue(true);
    }
}
