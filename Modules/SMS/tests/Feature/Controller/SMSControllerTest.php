<?php

namespace MODULES\SMS\Tests\Feature\Controller;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Event;
use Illuminate\Testing\Fluent\AssertableJson;
use MODULES\SMS\Database\Factories\SMSFactory;
use MODULES\SMS\Jobs\SendSMS;
use Tests\TestCase;

class SMSControllerTest extends TestCase
{
    use RefreshDatabase;
    public function test_get_list_of_all_sms_()
    {
        Event::fake();
        SMSFactory::times(12)->create();
        $this->get(route("sms.index"))
            ->assertStatus(200)
            ->assertJson(function (AssertableJson $json){
                $json
                    ->has("data",10)
                    ->has("data.0",function (AssertableJson $json){
                        $json
                            ->has("id")
                            ->has("number")
                            ->has("status")
                            ->has("body");
                    })
                    ->has("meta")
                    ->has("links")
                    ->etc();
            });
    }
    public function test_get_a_sms_by_its_id(){
        Event::fake();
        $sms=SMSFactory::times(10)->create()->first();
        $this->get(route("sms.show",["sms"=>$sms->id]))
            ->assertStatus(200)
            ->assertJson(function (AssertableJson $json)use($sms){
                $json->has("data")
                    ->has("data.id")
                    ->where("data.id",$sms->id)
                    ->has("data.number")
                    ->where("data.number",$sms->number)
                    ->has("data.body")
                    ->where("data.body",$sms->body);
            });
    }
    public function test_get_404_error_when_trying_to_get_a_not_existed_sms(){
        Event::fake();
        $this->get(route("sms.show",["sms"=>4]))
            ->assertStatus(404);
    }
    public function test_submit_a_sms(){
        Bus::fake();
        $this->post(route("sms.submit"),[
            "number"=>"09121230123",
            "body"=>"this is a test message"
        ])
            ->assertStatus(200)
            ->assertJson(function (AssertableJson $json){
                $json->has("data")
                    ->has("data.message")
                    ->where("data.message",__("sms::sms.your_request_submitted"));
            });
        Bus::assertDispatched(SendSMS::class);
    }
    public function test_get_422_error_code_when_parameters_are_not_valid(){
        Bus::fake();
        $this->post(route("sms.submit"),[
            "number"=>"000",
            "body"=>""
        ])
            ->assertStatus(422)
            ->assertJson(function (AssertableJson $json){
                $json->has("data")
                    ->has("data.message")
                    ->where("data.message",__("sms::sms.your_request_submitted"));
            });
        Bus::assertNotDispatched(SendSMS::class);
    }
}
