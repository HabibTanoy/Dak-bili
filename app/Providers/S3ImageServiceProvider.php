<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Aws\S3\S3Client;

class S3ImageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\Services\S3ImageService', function ($app) {
            return new \App\Services\S3ImageService();
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
