<?php

namespace Kadhamw\ConnectAPI;

use Illuminate\Support\ServiceProvider;

class ConnectAPIServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/ConnectAPI.php', 'connectapi');
    }

    public function boot()
    {
        $this->publishes([
        __DIR__.'/../config/ConnectAPI.php' => config_path('connectapi.php'),
        ], 'config');

    }
}
