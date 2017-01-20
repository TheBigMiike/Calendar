<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CalendarServiceProvider extends ServiceProvider{
    /**
    * Register the service provider.
    *
    * @return void
    */
    public function register(){
        $this->app->singleton('calendar', function() {
            return new ;
        });
    }
}