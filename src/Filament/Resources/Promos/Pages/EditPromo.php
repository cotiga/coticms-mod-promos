<?php

namespace Cotiga\ModulePromos\Filament\Resources\Promos\Pages;

use Cotiga\CotiCmsCore\Filament\Pages\CotiEditRecord;
use Cotiga\ModulePromos\Filament\Resources\Promos\PromoResource;
use Filament\Actions\DeleteAction;

class EditPromo extends CotiEditRecord
{
    protected static string $resource = PromoResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
