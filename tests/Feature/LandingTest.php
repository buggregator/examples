<?php
declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class LandingTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        logger()->setDefaultDriver('null');
    }

    function test_log()
    {
        ray()->trace()->hide();

        ray($this)->hide();

        ray(['I\'m RayServer'])->blue()->label('Welcome');
        ray('Hello Artisans!')->large();


        $this->assertTrue(true);
    }

    function test_colors_and_labels()
    {
        ray(['I\'m RayServer'])->blue()->label('Welcome');
        ray('Hello Artisans!')->large()->purple();
        ray('this is red')->red();
        ray('this is blue')->green()->label('Super label');
    }
}
