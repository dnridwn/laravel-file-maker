<?php

namespace Dnridwn\LaravelFileMaker\Commands;

use Illuminate\Console\Command;

class LaravelFileMakerCommand extends Command
{
    public $signature = 'laravel-file-maker';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
