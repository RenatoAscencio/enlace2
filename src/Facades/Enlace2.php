<?php

namespace Enlace2\LaravelUrlShortener\Facades;

use Illuminate\Support\Facades\Facade;

class Enlace2 extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'enlace2';
    }
}