<?php
declare(strict_types=1);

namespace Tests\Feature;

use App\Modules\Ray\RayLaravel;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RayLaravelTest extends TestCase
{
    use DatabaseMigrations, WithFaker, RayLaravel;

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->assertTrue(true);
    }

    /** @test */
    function rayResponse()
    {
        $this->get('/')
            ->ray()
            ->assertSuccessful();
    }
}
