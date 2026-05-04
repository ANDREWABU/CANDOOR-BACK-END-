<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class GenericHelperFacade extends Facade{


    protected static function getFacadeAccessor()
    {
        return 'helpers';
    }
}
