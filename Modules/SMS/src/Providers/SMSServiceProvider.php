<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

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
        Route::middleware('api')->namespace('SMS\Http\Controllers')
            ->group(__DIR__.'/../routes/api.php');
    }

}
