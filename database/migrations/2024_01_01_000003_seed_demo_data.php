<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Artisan;

return new class extends Migration
{
    public function up()
    {
        Artisan::call('db:seed', ['--force' => true]);
    }

    public function down()
    {
        // Nothing to undo — tables will be dropped by their own migrations
    }
};
