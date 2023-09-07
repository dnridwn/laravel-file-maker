<?php

namespace Dnridwn\LaravelFileMaker\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Dnridwn\LaravelFileMaker\LaravelFileMaker
 */
class LaravelFileMaker extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Dnridwn\LaravelFileMaker\LaravelFileMaker::class;
    }
}
