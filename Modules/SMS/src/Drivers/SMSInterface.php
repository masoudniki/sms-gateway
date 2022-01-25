<?php

namespace MODULES\SMS\Drivers;

interface SMSInterface
{
    public function send($number,$text);
}
