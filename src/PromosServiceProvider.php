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

        // Déclaration au socle : activer le module suffit à voir la modale, aucune
        // vue de projet à modifier. Seule la portée compte ici — une modale est en
        // overlay, l'emplacement ne change rien à l'écran.
        try {
            if (\Cotiga\CotiCmsCore\Models\ModuleSettings::get()->promos_actif) {
                \Cotiga\CotiCmsCore\Support\Slots::register(
                    key: 'promos',
                    view: 'promos::inc.slot',
                    label: 'Promos — modale promotionnelle',
                    zone: 'fin-de-page',
                    scope: 'accueil',
                );
            }
        } catch (\Exception $e) {
            // Table modules pas encore migrée
        }
    }
}
