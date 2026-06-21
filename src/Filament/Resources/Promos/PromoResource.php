<?php

namespace Cotiga\ModulePromos\Filament\Resources\Promos;

use BackedEnum;
use Cotiga\ModulePromos\Filament\Resources\Promos\Pages\CreatePromo;
use Cotiga\ModulePromos\Filament\Resources\Promos\Pages\EditPromo;
use Cotiga\ModulePromos\Filament\Resources\Promos\Pages\ListPromos;
use Cotiga\ModulePromos\Filament\Resources\Promos\Schemas\PromoForm;
use Cotiga\ModulePromos\Filament\Resources\Promos\Tables\PromosTable;
use Cotiga\ModulePromos\Models\Promo;
use Filament\Resources\Resource;
use UnitEnum;

class PromoResource extends Resource
{
    protected static ?string $model = Promo::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-megaphone';

    protected static ?string $navigationLabel = 'Promotions';

    protected static ?string $modelLabel = 'promotion';

    protected static ?string $pluralModelLabel = 'promotions';

    protected static UnitEnum|string|null $navigationGroup = 'Promotions';

    protected static ?int $navigationSort = 1;

    public static function canViewAny(): bool
    {
        return \Cotiga\CotiCmsCore\Models\ModuleSettings::get()->promos_actif;
    }

    public static function canAccess(): bool
    {
        return static::canViewAny();
    }

    public static function form(\Filament\Schemas\Schema $schema): \Filament\Schemas\Schema
    {
        return PromoForm::make($schema);
    }

    public static function table(\Filament\Tables\Table $table): \Filament\Tables\Table
    {
        return PromosTable::make($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPromos::route('/'),
            'create' => CreatePromo::route('/create'),
            'edit' => EditPromo::route('/{record}/edit'),
        ];
    }
}
