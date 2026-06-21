<?php

namespace Cotiga\ModulePromos\Filament\Resources\Promos\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PromosTable
{
    public static function make(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('titre')
                    ->label('Titre')
                    ->searchable()
                    ->limit(50),

                TextColumn::make('date_debut')
                    ->label('Début')
                    ->date('d/m/Y')
                    ->placeholder('—'),

                TextColumn::make('date_fin')
                    ->label('Fin')
                    ->date('d/m/Y')
                    ->placeholder('—'),

                IconColumn::make('onl')
                    ->label('En ligne')
                    ->boolean(),
            ])
            ->defaultSort('updated_at', 'desc')
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
