<?php

namespace MrBohem\LivewireFormKeeper;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use MrBohem\LivewireFormKeeper\Commands\LivewireFormKeeperCommand;

class LivewireFormKeeperServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('livewire-form-keeper')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_livewire-form-keeper_table')
            ->hasCommand(LivewireFormKeeperCommand::class);
    }
}
