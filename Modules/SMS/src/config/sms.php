<?php
    return [
        /*
        |--------------------------------------------------------------------------
        | Default sms service provider
        |--------------------------------------------------------------------------
        |
        | Here you may specify which of the sms provider below you wish
        | to use as your default provider for all sms
        |
        */
        "driver"=>env("SMS_DRIVER","ghasedak"),

        /*
        |--------------------------------------------------------------------------
        | sms service providers
        |--------------------------------------------------------------------------
        |
        | here there are a list of supported drivers.you can easily add your driver
        | by implementing SMSInterface and register it in SMSServiceProvider then
        | define your driver at the end of this list
        */
        "providers"=>[
            "ghasedak"=>[
                "api_token"=>env("SMS_API_TOKEN"),
                "base_uri"=>env("SMS_BASE_URI","http://api.ghasedak.me/v2/"),
                "verify_ssl"=>env("SMS_VERIFY_SSL",false),
                "line_number"=>env("SMS_LINE_NUMBER","10008566")
            ],
            "kavenegar"=>[
                "api_token"=>env("SMS_API_TOKEN"),
                "base_uri"=>env("SMS_BASE_URI","https://api.kavenegar/v1/"),
            ]
        ]








    ];
