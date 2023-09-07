<?php

namespace Dnridwn\LaravelFileMaker;

use Dnridwn\LaravelFileMaker\Commands\InterfaceMakerCommand;
use Dnridwn\LaravelFileMaker\Commands\RepositoryMakerCommand;
use Dnridwn\LaravelFileMaker\Commands\ServiceMakerCommand;
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
            ->hasCommands([
                ServiceMakerCommand::class,
                InterfaceMakerCommand::class,
                RepositoryMakerCommand::class,
            ]);
    }
}
