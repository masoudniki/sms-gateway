<?php

namespace MODULES\SMS\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
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
        foreach ($events as $event){
            foreach ($event as $listener){
                Event::listen($event,$listener);
            }
        }
    }

}
