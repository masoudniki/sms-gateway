<?php

namespace MODULES\SMS\Drivers\Ghasedak;

use GuzzleHttp\Client;
use MODULES\SMS\Drivers\SMSInterface;

class Ghasedak implements SMSInterface
{
    public $httpClient;
    public function __construct(public string $api_token,public string $base_uri,public bool $verify_ssl,public string $lineNumber){
        $this->httpClient=new Client([
            "base_uri"=>rtrim($this->base_uri,"/")."/",
            "verify_ssl"=>$this->verify_ssl,
            "headers"=>[
                'apikey'=>$this->api_token,
                'Accept'=> 'application/json',
                'Content-Type'=>'application/x-www-form-urlencoded',
                'charset'=>'utf-8'
            ]
        ]);
    }
    public function setHttpClient($client){
        $this->httpClient=$client;
    }
    public function getHttpClient(){
        return $this->httpClient;
    }
    public function send($number, $text)
    {
        return $this->httpClient->post("sms/send/simple",[
            'form_params'=>[
                'receptor'=>$number,
                "message"=>$text,
                'linenumber'=>$this->lineNumber
            ]
        ]);
    }
}
