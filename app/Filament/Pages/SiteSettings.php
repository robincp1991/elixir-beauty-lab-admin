<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class SiteSettings extends Page implements HasSchemas
{
    use InteractsWithSchemas;
    protected string $view = 'filament.pages.site-settings';
    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static ?string $navigationLabel = 'Configuración';

    protected static string|null|\UnitEnum $navigationGroup = 'Sitio web';

    protected static ?string $title = 'Configuración del sitio';

    public ?array $data = [];

    public function mount(): void
    {
        $setting = SiteSetting::query()->firstOrCreate([]);

        $data = $setting->toArray();

        $data['opening_hours'] = $setting->opening_hours ?? [];
        $data['social_links'] = $setting->social_links ?? [];

        $this->form->fill($data);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Configuración')
                    ->tabs([
                        Tab::make('General')
                            ->icon(Heroicon::OutlinedBuildingStorefront)
                            ->schema([
                                TextInput::make('business_name')
                                    ->label('Nombre del negocio')
                                    ->maxLength(255),

                                Textarea::make('description')
                                    ->label('Descripción corta')
                                    ->rows(3)
                                    ->columnSpanFull(),

                                Textarea::make('full_description')
                                    ->label('Descripción completa')
                                    ->rows(5)
                                    ->columnSpanFull(),

                                TextInput::make('phone')
                                    ->label('Teléfono')
                                    ->tel(),

                                TextInput::make('whatsapp')
                                    ->label('WhatsApp')
                                    ->tel()
                                    ->helperText('Incluye el código de país.'),

                                TextInput::make('email')
                                    ->label('Email')
                                    ->email(),

                                Textarea::make('address')
                                    ->label('Dirección')
                                    ->rows(2)
                                    ->columnSpanFull(),
                            ])
                            ->columns(2),

                        Tab::make('Horarios')
                            ->icon(Heroicon::OutlinedClock)
                            ->schema([
                                Repeater::make('opening_hours')
                                    ->label('Horarios de atención')
                                    ->schema([
                                        Select::make('day')
                                            ->label('Día')
                                            ->options([
                                                'monday' => 'Lunes',
                                                'tuesday' => 'Martes',
                                                'wednesday' => 'Miércoles',
                                                'thursday' => 'Jueves',
                                                'friday' => 'Viernes',
                                                'saturday' => 'Sábado',
                                                'sunday' => 'Domingo',
                                            ]),

                                        TimePicker::make('open')
                                            ->label('Apertura')
                                            ->seconds(false),

                                        TimePicker::make('close')
                                            ->label('Cierre')
                                            ->seconds(false),

                                        Toggle::make('closed')
                                            ->label('Cerrado')
                                            ->default(false),
                                    ])
                                    ->columns(4)
                                    ->addActionLabel('Agregar día')
                                    ->reorderable(false)
                                    ->columnSpanFull(),
                            ]),

                        Tab::make('Redes sociales')
                            ->icon(Heroicon::OutlinedShare)
                            ->schema([
                                KeyValue::make('social_links')
                                    ->label('Redes sociales')
                                    ->keyLabel('Red social')
                                    ->valueLabel('URL del perfil')
                                    ->addActionLabel('Agregar red social')
                                    ->reorderable()
                                    ->columnSpanFull()
                                    ->helperText('Ejemplo: instagram → https://instagram.com/tuusuario'),
                            ]),
                    ])
                    ->columnSpanFull(),
            ])
            ->statePath('data')
            ->model(SiteSetting::class);
    }

    public function save(): void
    {
        $data = $this->form->getState();

        SiteSetting::query()->firstOrCreate([])
            ->update($data);

        Notification::make()
            ->title('Configuración guardada')
            ->success()
            ->send();
    }

    private function defaultOpeningHours(): array
    {
        return collect([
            'monday',
            'tuesday',
            'wednesday',
            'thursday',
            'friday',
            'saturday',
            'sunday',
        ])->map(fn (string $day) => [
            'day' => $day,
            'open' => '09:00',
            'close' => '18:00',
            'closed' => $day === 'sunday',
        ])->all();
    }
}
