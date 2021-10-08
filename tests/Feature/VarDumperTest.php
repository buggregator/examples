<?php
declare(strict_types=1);

namespace Tests\Feature;

use App\Modules\VarDump\Common;
use Tests\TestCase;

class VarDumperTest extends TestCase
{
    use Common;

    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpVarDumper();
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->assertTrue(true);
    }
}
