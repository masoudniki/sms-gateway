<?php

use Illuminate\Support\Facades\Route;

Route::group(["prefix"=>"v1"],function (){
    Route::group(["prefix"=>"sms"],function (){
        Route::get("/",[
            "uses"=>"SMSController@index",
            "as"=>"sms.index"
        ]);
        Route::get("/{sms}",[
            "uses"=>"SMSController@show",
            "as"=>"sms.show"
        ]);
        Route::post("/submit",[
            "uses"=>"SMSController@submit",
            "as"=>"sms.submit"
        ]);
    });
});
