<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Str::macro('miles', function ($price)
        {
            if($price){

                return ' $ '.number_format($price, 0, '', '.');
            }
        });

        Str::macro('fecha', function ($price)
        {
            $date = Carbon::parse($price);

            
            return $date->toDateTimeString(); 
        });
    }
}
