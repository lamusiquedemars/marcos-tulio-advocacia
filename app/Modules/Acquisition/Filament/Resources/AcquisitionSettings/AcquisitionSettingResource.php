<?php

namespace App\Modules\Acquisition\Filament\Resources\AcquisitionSettings;

use App\Modules\Acquisition\Filament\Resources\AcquisitionSettings\Pages\ManageAcquisitionSettings;
use App\Modules\Acquisition\Models\AcquisitionSetting;
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

class AcquisitionSettingResource extends Resource
{
    protected static ?string $model = AcquisitionSetting::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChartBarSquare;

    protected static ?string $navigationLabel = 'Aquisição';

    protected static UnitEnum|string|null $navigationGroup = 'Marketing';

    protected static ?string $modelLabel = 'configuração de aquisição';

    protected static ?string $pluralModelLabel = 'aquisição';

    public static function shouldRegisterNavigation(): bool
    {
        return Modules::enabled('acquisition');
    }

    public static function canAccess(): bool
    {
        return Modules::enabled('acquisition') && parent::canAccess();
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Medição do site')
                ->description('O site conhece apenas o contêiner GTM. Analytics e Ads permanecem configurados no Google.')
                ->schema([
                    Toggle::make('is_enabled')->label('Ativar medição')->live(),
                    TextInput::make('gtm_container_id')
                        ->label('Identificador Google Tag Manager')
                        ->placeholder('GTM-ABC1234')
                        ->maxLength(32),
                ])->columns(2),
            Section::make('Consentimento')
                ->schema([
                    Toggle::make('consent_enabled')->label('Solicitar consentimento'),
                    Select::make('consent_mode')
                        ->label('Modo')
                        ->options([
                            'basic' => 'Basic — nenhuma medição antes da aceitação',
                            'advanced' => 'Advanced — sinais limitados antes da aceitação',
                        ])->required(),
                    TextInput::make('privacy_policy_url')
                        ->label('Política de privacidade')
                        ->url()
                        ->maxLength(2048)
                        ->columnSpanFull(),
                ])->columns(2),
            Section::make('Relatórios')
                ->schema([
                    TextInput::make('timezone')->label('Fuso horário')->required()->maxLength(64),
                    TextInput::make('currency')->label('Moeda')->required()->length(3),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                IconColumn::make('is_enabled')->label('Ativa')->boolean(),
                TextColumn::make('gtm_container_id')->label('Contêiner GTM')->placeholder('Não configurado'),
                TextColumn::make('consent_mode')->label('Consentimento'),
                TextColumn::make('currency')->label('Moeda'),
            ])
            ->recordActions([EditAction::make()->label('Configurar')])
            ->toolbarActions([]);
    }

    public static function getPages(): array
    {
        return ['index' => ManageAcquisitionSettings::route('/')];
    }
}
