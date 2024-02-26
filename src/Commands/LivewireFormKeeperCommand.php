<?php

namespace MrBohem\LivewireFormKeeper\Commands;

use Illuminate\Console\Command;

class LivewireFormKeeperCommand extends Command
{
    public $signature = 'livewire-form-keeper';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
