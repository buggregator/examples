<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class InspectorTest extends Command
{
    protected $signature = 'inspector:test';
    protected $description = 'Command description';

    public function handle()
    {
        $this->output->writeln('Hello World');

        return Command::SUCCESS;
    }
}
