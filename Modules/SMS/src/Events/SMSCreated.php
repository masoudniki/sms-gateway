<?php

namespace MODULES\SMS\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use MODULES\SMS\Models\SMS;

class SMSCreated
{
    use Dispatchable, SerializesModels;
    public function __construct(public SMS $SMS){
    }
}
