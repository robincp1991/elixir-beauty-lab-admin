<?php

namespace App\Filament\Resources\GalleryPhotos\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class GalleryPhotoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('src')
                    ->label('Imagen')
                    ->image()
                    ->disk('r2')
                    ->directory('images/gallery')
                    ->required()
                    ->maxSize(5120)
                    ->optimize('webp', '80')
                    ->columnSpanFull(),

                TextInput::make('alt')
                    ->label('Texto alternativo')
                    ->maxLength(255)
                    ->placeholder('Describe brevemente la imagen'),

                Select::make('category')
                    ->label('Categoría')
                    ->options([
                        'resultados' => 'Resultados',
                        'tratamientos' => 'Tratamientos',
                        'el studio' => 'El estudio',
                    ])
                    ->required(),

                Toggle::make('active')
                    ->label('Activa')
                    ->default(true),

                Toggle::make('featured')
                    ->label('Destacada en inicio')
                    ->default(false),
            ]);
    }
}
