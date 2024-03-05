<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Faker\Factory as FakerFactory;

class FakerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Faker\Generator', function () {
            return FakerFactory::create();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
