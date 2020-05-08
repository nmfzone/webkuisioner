<?php

namespace App\Garages\Database;

use Illuminate\Support\ServiceProvider;

class EloquentServiceProvider extends ServiceProvider
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
        $this->app->extend('db.factory', function () {
            return new ConnectionFactory($this->app);
        });
    }
}
