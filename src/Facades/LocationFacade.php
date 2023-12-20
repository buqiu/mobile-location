<?php

namespace Buqiu\MobileLocation\Facades;

use Illuminate\Support\Facades\Facade;

class LocationFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'location';
    }
}