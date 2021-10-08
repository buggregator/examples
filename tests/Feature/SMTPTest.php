<?php
declare(strict_types=1);

namespace Tests\Feature;

use App\Modules\Smtp\Common;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SMTPTest extends TestCase
{
    use WithFaker, Common;

    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpSmtp();
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->assertTrue(true);
    }
}
