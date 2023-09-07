<?php

namespace Dnridwn\LaravelFileMaker;

use Dnridwn\LaravelFileMaker\Commands\LaravelFileMakerCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
<<<<<<< Updated upstream
=======
use Dnridwn\LaravelFileMaker\Commands\ServiceMakerCommand;
>>>>>>> Stashed changes

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
