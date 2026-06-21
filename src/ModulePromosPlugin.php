<?php

namespace Cotiga\ModulePromos;

use Filament\Contracts\Plugin;
use Filament\Panel;

class ModulePromosPlugin implements Plugin
{
    public static function make(): static
    {
        return new static;
    }

    public function getId(): string
    {
        return 'promos';
    }

    public function register(Panel $panel): void
    {
        $panel->discoverResources(
            in: __DIR__.'/Filament/Resources',
            for: 'Cotiga\\ModulePromos\\Filament\\Resources',
        );
    }

    public function boot(Panel $panel): void {}
}
