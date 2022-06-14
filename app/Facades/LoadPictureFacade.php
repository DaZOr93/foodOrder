<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class LoadPictureFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'image';
    }
}
