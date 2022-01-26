<?php

namespace MODULES\SMS\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use MODULES\SMS\Events\SMSCreated;
use MODULES\SMS\Jobs\SendSMS;

class SMSCreatedListener
{
    public function handle(SMSCreated $event)
    {
        SendSMS::dispatch($event->SMS);
    }
}
