<?php

declare(strict_types=1);

namespace App\MyService;

use App\Models\User;

final class MyService
{
    public function __construct() {}

    public function call(): array
    {
        $result = [];
        for ($i = 0; $i < 1_000; $i++) {
            $result[] = User::factory()->makeOne();
        }

        return $result;
    }
}
