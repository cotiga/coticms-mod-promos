<?php

namespace Cotiga\ModulePromos\Filament\Resources\Promos\Schemas;

use Cotiga\CotiCmsCore\Support\TinyEditorHelper;
use Filament\Forms;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class PromoForm
{
    public static function make(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\TextInput::make('titre')
                    ->label('Titre')
                    ->maxLength(150)
                    ->columnSpanFull(),

                Grid::make(3)
                    ->schema([
                        Forms\Components\DatePicker::make('date_debut')
                            ->label('Début de validité')
                            ->native(false)
                            ->displayFormat('d/m/Y')
                            ->helperText('Vide = pas de date de début'),

                        Forms\Components\DatePicker::make('date_fin')
                            ->label('Fin de validité')
                            ->native(false)
                            ->displayFormat('d/m/Y')
                            ->helperText('Vide = pas de date de fin'),

                        Forms\Components\Toggle::make('onl')
                            ->label('En ligne')
                            ->default(false)
                            ->inline(false),
                    ])
                    ->columnSpanFull(),

                TinyEditorHelper::make('contenu', 'Contenu de la promotion')
                    ->profile('default')
                    ->columnSpanFull(),
            ]);
    }
}
