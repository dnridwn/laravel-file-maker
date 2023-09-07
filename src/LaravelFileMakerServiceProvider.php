<?php

namespace Dnridwn\LaravelFileMaker;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Dnridwn\LaravelFileMaker\Commands\ServiceMakerCommand;

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
            ->hasCommand(ServiceMakerCommand::class);
    }
}
