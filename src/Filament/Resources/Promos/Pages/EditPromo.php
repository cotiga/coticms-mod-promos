<?php

namespace Cotiga\ModulePromos\Filament\Resources\Promos\Pages;

use Cotiga\ModulePromos\Filament\Resources\Promos\PromoResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPromo extends EditRecord
{
    protected static string $resource = PromoResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
