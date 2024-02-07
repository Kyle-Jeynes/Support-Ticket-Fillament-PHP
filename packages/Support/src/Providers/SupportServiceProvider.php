<?php

namespace Package\Support\Providers;

use Package\Support\Contracts\SupportServiceContract;
use Package\Support\Services\SupportService;

class SupportServiceProvider extends Illuminate\Support\ServiceProvider
{
    public function boot()
    {
        $this->app->bind(SupportServiceContract::class, SupportService::class);

        // TODO
        // $this->loadViewsFrom(__DIR__ . '/../resources/views', 'Support');
        // $this->loadRoutesFrom(__DIR__ . '/../Http/routes.php);
    }
}