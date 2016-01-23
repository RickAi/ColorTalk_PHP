<?php

namespace App\Providers;

use App\Services\RongService;
use Illuminate\Support\ServiceProvider;

class RongServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('rongcloud', function()
        {
            return new RongService;
        });
    }
}
