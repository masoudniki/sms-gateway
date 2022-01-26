<?php

namespace MODULES\SMS\Tests\Unit\Ghasedak;



use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use MODULES\SMS\Drivers\Ghasedak\Ghasedak;
use PHPUnit\Framework\TestCase;

class GhasedakDriverTest extends TestCase
{
    public function test_send_sms(){
        $ghasedak=new Ghasedak("test","http://localhost/v1/",false);
        $mockHandler=new MockHandler();
        $mockHandler->append(new Response(200, [], file_get_contents(__DIR__.'/mockResponse/send.json')));
        $ghasedak->setHttpClient($mockHandler);
        $ghasedak->send("09101234556","this is a text message");
    }

}
