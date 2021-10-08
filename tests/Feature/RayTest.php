<?php
declare(strict_types=1);

namespace Tests\Feature;

use App\Modules\Ray\RayCommon;
use Tests\TestCase;

class RayTest extends TestCase
{
    use RayCommon;
    
    protected function tearDown(): void
    {
        parent::tearDown();

        $this->assertTrue(true);
    }
}
