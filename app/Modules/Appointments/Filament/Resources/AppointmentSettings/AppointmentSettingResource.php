<?php

namespace App\Modules\Appointments\Filament\Resources\AppointmentSettings;

use App\Modules\Appointments\Enums\AppointmentMode;
use App\Modules\Appointments\Enums\AppointmentProvider;
use App\Modules\Appointments\Filament\Resources\AppointmentSettings\Pages\ManageAppointmentSettings;
use App\Modules\Appointments\Models\AppointmentSetting;
use App\Support\Modules;
use BackedEnum;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class AppointmentSettingResource extends Resource
{
    protected static ?string $model = AppointmentSetting::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCalendarDays;

    protected static ?string $navigationLabel = 'Agendamento';

    protected static UnitEnum|string|null $navigationGroup = 'Atendimento';

    protected static ?string $modelLabel = 'configuração de agendamento';

    protected static ?string $pluralModelLabel = 'configuração de agendamento';

    protected static ?int $navigationSort = 20;

    public static function shouldRegisterNavigation(): bool
    {
        return Modules::enabled('appointments');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Brevo Meetings')
                ->description('A reserva usa apenas a página de agendamento. Nenhuma ferramenta de videoconferência é configurada aqui.')
                ->schema([
                    Toggle::make('is_enabled')
                        ->label('Ativar o agendamento')
                        ->live(),
                    Select::make('provider')
                        ->label('Provedor')
                        ->options(self::providerOptions())
                        ->required(),
                    Select::make('mode')
                        ->label('Momento da reserva')
                        ->options(self::modeOptions())
                        ->required(),
                    TextInput::make('booking_url')
                        ->label('Link da página de agendamento')
                        ->url()
                        ->maxLength(2048)
                        ->helperText('Copie o link em Brevo: Conversas > Meetings. Nenhum dado do caso será acrescentado à URL.')
                        ->columnSpanFull(),
                    TextInput::make('timezone')
                        ->label('Fuso horário profissional')
                        ->required()
                        ->default('America/Cuiaba')
                        ->helperText('Use um identificador IANA, por exemplo America/Cuiaba.'),
                ])
                ->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                IconColumn::make('is_enabled')->label('Ativo')->boolean(),
                TextColumn::make('provider')
                    ->label('Provedor')
                    ->formatStateUsing(fn (AppointmentProvider $state): string => $state->label()),
                TextColumn::make('mode')
                    ->label('Modo')
                    ->formatStateUsing(fn (AppointmentMode $state): string => $state->label()),
                TextColumn::make('timezone')->label('Fuso horário'),
                TextColumn::make('booking_url')->label('Página de agendamento')->limit(45),
            ])
            ->recordActions([
                EditAction::make()->label('Configurar'),
            ])
            ->toolbarActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageAppointmentSettings::route('/'),
        ];
    }

    private static function providerOptions(): array
    {
        return collect(AppointmentProvider::cases())
            ->mapWithKeys(fn (AppointmentProvider $provider): array => [$provider->value => $provider->label()])
            ->all();
    }

    private static function modeOptions(): array
    {
        return collect(AppointmentMode::cases())
            ->mapWithKeys(fn (AppointmentMode $mode): array => [$mode->value => $mode->label()])
            ->all();
    }
}
