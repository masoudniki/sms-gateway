<?php

namespace MODULES\SMS\Facade;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Facade;

/**
 * @method static mixed send(string $phoneNumber, string $text)
 */
class SMS extends Facade
{

    public static function getFacadeAccessor()
    {
        return config("sms.driver");
    }
}
