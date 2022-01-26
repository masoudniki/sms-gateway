<?php

namespace MODULES\SMS\Tests\Feature\Job;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use MODULES\SMS\Database\Factories\SMSFactory;
use MODULES\SMS\Facade\SMS;
use MODULES\SMS\Jobs\SendSMS;
use Tests\TestCase;

class SendSMSJobTest extends TestCase
{

    public function test_sms_sent_successfully()
    {
        Event::fake();
        $sms=SMSFactory::times(1)->create()->first();
        SMS::shouldReceive("send")
            ->withAnyArgs()
            ->andReturnTrue();
        (new SendSMS($sms))->handle();
        $sms=$sms->fresh();
        $this->assertEquals(\MODULES\SMS\Models\SMS::SENT,$sms->status);
    }
    public function test_sms_failed(){
        Event::fake();
        $sms=SMSFactory::times(1)->create()->first();
        SMS::shouldReceive("send")
            ->withAnyArgs()
            ->andThrow(\Exception::class,"something went wrong");
        (new SendSMS($sms))->handle();
        $sms=$sms->fresh();
        $this->assertEquals(\MODULES\SMS\Models\SMS::FAILED,$sms->status);
        $this->assertEquals("something went wrong",$sms->error_message);
    }
}
