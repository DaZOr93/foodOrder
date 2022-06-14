<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\LoadPictureService;

class LoadPictureServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('image', function() {
            return new LoadPictureService();
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
