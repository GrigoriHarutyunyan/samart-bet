<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BootstrapServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Services\Settings\SettingsServiceInterface::class, \App\Services\Settings\SettingsService::class);
        $this->app->bind(\App\Services\History\HistoryServiceInterface::class, \App\Services\History\HistoryService::class);
        //:end-bindings:
    }
}
