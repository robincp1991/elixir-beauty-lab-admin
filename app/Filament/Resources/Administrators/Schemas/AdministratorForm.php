<?php

namespace App\Filament\Resources\Administrators\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AdministratorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Información del administrador')
                ->schema([

                    TextInput::make('name')
                        ->label('Nombre completo')
                        ->required()
                        ->maxLength(255),

                    TextInput::make('email')
                        ->label('Correo electrónico')
                        ->email()
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->maxLength(255),

                ])->columns(2),

            Section::make('Seguridad')
                ->schema([

                    TextInput::make('password')
                        ->label('Contraseña')
                        ->password()
                        ->revealable()
                        ->required(fn (string $operation) => $operation === 'create')
                        ->minLength(8)
                        ->dehydrated(fn ($state) => filled($state))
                        ->autocomplete('new-password'),

                    TextInput::make('password_confirmation')
                        ->label('Confirmar contraseña')
                        ->password()
                        ->revealable()
                        ->required(fn (string $operation) => $operation === 'create')
                        ->same('password')
                        ->dehydrated(false),

                ])->columns(2),

        ]);
    }
}
