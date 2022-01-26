<?php

namespace MODULES\SMS\Drivers\Kavenegar;

use MODULES\SMS\Drivers\SMSInterface;

class Kavenegar implements SMSInterface
{
    public function __construct(public string $api_token,public string $base_uri)
    {}
    public function send($number, $text)
    {
        return "sms sent";
    }
}
