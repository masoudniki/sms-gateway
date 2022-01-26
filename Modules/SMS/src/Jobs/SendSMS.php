<?php

namespace MODULES\SMS\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use MODULES\SMS\Models\SMS;

class SendSMS implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public function __construct(
        public SMS $SMS
    ){
        $this->queue="sms";
    }
    public function handle()
    {
        try {
            \MODULES\SMS\Facade\SMS::send($this->SMS->number,$this->SMS->body);
            $this->SMS->status=SMS::SENT;
        }catch (\Exception $exception){
            $this->SMS->status=SMS::FAILED;
            $this->SMS->error_message=$exception->getMessage();
        }finally{
            $this->SMS->save();
        }
    }
}
