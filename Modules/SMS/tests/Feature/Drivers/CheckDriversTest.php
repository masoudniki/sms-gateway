<?php

namespace MODULES\SMS\Tests\Feature\Drivers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use MODULES\SMS\Drivers\Ghasedak\Ghasedak;
use MODULES\SMS\Drivers\Kavenegar\Kavenegar;
use MODULES\SMS\Facade\SMS;
use Tests\TestCase;

class CheckDriversTest extends TestCase
{
    public function test_get_ghasedak_driver_from_sms_facade(){
        $this->app['config']->set('sms.driver', 'ghasedak');
        $driver=SMS::getFacadeRoot();
        $this->assertInstanceOf(Ghasedak::class,$driver);
    }
    public function test_get_kavenegar_driver_from_sms_facade(){
        $this->app['config']->set('sms.driver', 'kavenegar');
        $driver=SMS::getFacadeRoot();
        $this->assertInstanceOf(Kavenegar::class,$driver);
    }
}
