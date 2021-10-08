<?php
declare(strict_types=1);

namespace Tests\Feature;

use App\Modules\Inspector\Common;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class InspectorTest extends TestCase
{
    use DatabaseMigrations, Common;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->assertTrue(true);
    }

    /** @test */
    public function inspect()
    {
        $this->get('/inspector')
            ->assertOk();
    }
}
