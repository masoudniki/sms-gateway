<?php

namespace MODULES\SMS\Drivers;

use Illuminate\Support\Facades\Facade;

class SMS extends Facade
{
    public static function getFacadeAccessor()
    {
        return config("sms.driver");
    }
}
