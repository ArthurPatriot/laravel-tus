<?php

namespace ArthurPatriot\Tus\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \ArthurPatriot\Tus\Tus
 */
class Tus extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \ArthurPatriot\Tus\Tus::class;
    }
}
