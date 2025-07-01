<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MenuRepoServiceProvide extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->bind('App\Repositories\Menu\MenuInterface', 'App\Repositories\Menu\MenuRepository');
    }
}
