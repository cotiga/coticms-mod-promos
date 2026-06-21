<?php

namespace Cotiga\ModulePromos;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class PromosServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'promos');
        $this->publishes([__DIR__.'/../resources/views' => resource_path('views/vendor/promos')], 'module-promos-views');

        // <x-promos::modal /> → resources/views/components/modal.blade.php
        Blade::anonymousComponentNamespace('promos::components', 'promos');
    }
}
