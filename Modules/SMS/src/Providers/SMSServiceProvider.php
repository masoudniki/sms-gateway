<?php

namespace MODULES\SMS\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use MODULES\SMS\Drivers\Ghasedak\Ghasedak;
use MODULES\SMS\Drivers\Kavenegar\Kavenegar;
use MODULES\SMS\Events\SMSCreated;
use MODULES\SMS\Listeners\SMSCreatedListener;

class SMSServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadConfig();
        $this->loadMigrations();
        $this->loadRoutes();
        $this->loadTranslations();
        $this->registerEvents();
        $this->registerDrivers();

    }
    private function loadConfig(){
        $this->mergeConfigFrom(dirname(__DIR__) . DIRECTORY_SEPARATOR."config/sms.php","sms");
    }
    private function loadMigrations(){
        $this->loadMigrationsFrom(dirname(__DIR__) . DIRECTORY_SEPARATOR."Database/migrations");
    }
    private function loadTranslations(){
        $this->loadTranslationsFrom(dirname(__DIR__) . DIRECTORY_SEPARATOR."resources/lang","sms");
    }
    private function loadRoutes(){
        Route::middleware('api')
            ->namespace('MODULES\SMS\Http\Controllers')
            ->prefix("api")
            ->group(__DIR__.'/../routes/api.php');
    }
    private function registerEvents(){
        $events=[
            SMSCreated::class=>[
                SMSCreatedListener::class
            ]
        ];
        foreach ($events as $event=>$listeners){
            foreach ($listeners as $listener){
                Event::listen($event,$listener);
            }
        }
    }
    private function registerDrivers(){
        $this->app->bind("kavenegar",function (){
            return new Kavenegar(
                config("sms.providers.kavenegar.api_token"),
                config("sms.providers.kavenegar.base_uri")
            );
        });
        $this->app->bind("ghasedak",function (){
            return new Ghasedak(
                config("sms.providers.ghasedak.api_token"),
                config("sms.providers.ghasedak.base_uri"),
                config("sms.providers.ghasedak.verify_ssl"),
                config("sms.providers.ghasedak.line_number"),
            );
        });
    }

}
