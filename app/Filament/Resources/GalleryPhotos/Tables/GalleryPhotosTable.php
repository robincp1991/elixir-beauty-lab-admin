<?php

namespace App\Filament\Resources\GalleryPhotos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class GalleryPhotosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('src')
                    ->label('Imagen')
                    ->disk('r2')
                    ->square()
                    ->size(65),

                TextColumn::make('alt')
                    ->label('Descripción')
                    ->limit(35)
                    ->searchable(),

                TextColumn::make('category')
                    ->label('Categoría')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'resultados' => 'success',
                        'tratamientos' => 'info',
                        'el studio' => 'warning',
                        default => 'gray',
                    }),

                TextColumn::make('sort_order')
                    ->label('Orden')
                    ->sortable(),

                ToggleColumn::make('active')
                    ->label('Activa'),

                ToggleColumn::make('featured')
                    ->label('Destacada'),

            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
