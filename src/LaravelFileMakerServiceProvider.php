<?php

namespace Dnridwn\LaravelFileMaker;

use Dnridwn\LaravelFileMaker\Commands\LaravelFileMakerCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelFileMakerServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-file-maker')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-file-maker_table')
            ->hasCommand(LaravelFileMakerCommand::class);
    }
}
