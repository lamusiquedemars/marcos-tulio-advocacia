<?php

namespace App\Filament\Resources\OralDefenses;

use App\Filament\Resources\OralDefenses\Pages\CreateOralDefense;
use App\Filament\Resources\OralDefenses\Pages\EditOralDefense;
use App\Filament\Resources\OralDefenses\Pages\ListOralDefenses;
use App\Modules\Media\Filament\Forms\Components\MediaPicker;
use App\Modules\OralDefenses\Enums\OralDefenseStatus;
use App\Modules\OralDefenses\Enums\OralDefenseType;
use App\Modules\OralDefenses\Models\OralDefense;
use App\Support\Modules;
use BackedEnum;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use UnitEnum;

class OralDefenseResource extends Resource
{
    protected static ?string $model = OralDefense::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedVideoCamera;

    protected static ?string $navigationLabel = 'Sustentações e defesas';

    protected static UnitEnum|string|null $navigationGroup = 'Conteúdo jurídico';

    protected static ?string $modelLabel = 'sustentação ou defesa';

    protected static ?string $pluralModelLabel = 'sustentações e defesas';

    protected static ?int $navigationSort = 10;

    public static function shouldRegisterNavigation(): bool
    {
        return Modules::enabled('oral_defenses');
    }

    public static function canAccess(): bool
    {
        return Modules::enabled('oral_defenses') && parent::canAccess();
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Conteúdo')
                ->description('Use somente material fictício ou expressamente autorizado e anonimizado.')
                ->schema([
                    Select::make('type')
                        ->label('Tipo')
                        ->options(self::typeOptions())
                        ->default(OralDefenseType::Video->value)
                        ->live()
                        ->required(),
                    TextInput::make('title')
                        ->label('Título')
                        ->required()
                        ->maxLength(255),
                    Textarea::make('context')
                        ->label('Contexto breve')
                        ->rows(3)
                        ->columnSpanFull()
                        ->maxLength(1000),
                ])
                ->columns(2),
            Section::make('Vídeo')
                ->description('Informe um link público ou escolha um arquivo MP4/WebM. Um dos dois é suficiente.')
                ->visible(fn ($get): bool => $get('type') === OralDefenseType::Video->value)
                ->schema([
                    TextInput::make('video_url')
                        ->label('Link do vídeo')
                        ->url()
                        ->maxLength(2048)
                        ->placeholder('https://…'),
                    MediaPicker::make('video_media_id')
                        ->label('Vídeo da biblioteca')
                        ->relationship('videoMedia', 'display_name')
                        ->videosOnly(),
                    MediaPicker::make('thumbnail_media_id')
                        ->label('Imagem de capa')
                        ->relationship('thumbnailMedia', 'display_name')
                        ->imagesOnly()
                        ->columnSpanFull(),
                    Toggle::make('is_featured')
                        ->label('Vídeo principal')
                        ->helperText('Só pode existir um vídeo principal publicado. O sistema nunca substitui outro automaticamente.'),
                ])
                ->columns(2),
            Section::make('Exemplo anonimizado de defesa')
                ->description('Não inclua nomes, números processuais ou qualquer dado que permita identificar uma pessoa.')
                ->visible(fn ($get): bool => $get('type') === OralDefenseType::Defense->value)
                ->schema([
                    Textarea::make('initial_situation')
                        ->label('Situação inicial')
                        ->rows(3),
                    Textarea::make('legal_question')
                        ->label('Questão jurídica')
                        ->rows(3),
                    Textarea::make('strategy')
                        ->label('Estratégia')
                        ->rows(3),
                    Textarea::make('intervention')
                        ->label('Intervenção realizada')
                        ->rows(3),
                    Toggle::make('is_anonymized')
                        ->label('Anonimização verificada')
                        ->helperText('Obrigatório para publicar.')
                        ->columnSpanFull(),
                ])
                ->columns(2),
            Section::make('Publicação')
                ->schema([
                    Select::make('status')
                        ->label('Estado')
                        ->options(self::statusOptions())
                        ->default(OralDefenseStatus::Draft->value)
                        ->required(),
                    TextInput::make('position')
                        ->label('Ordem')
                        ->numeric()
                        ->minValue(0)
                        ->default(0)
                        ->required(),
                    DateTimePicker::make('published_at')
                        ->label('Publicar a partir de')
                        ->helperText('Vazio: publicação imediata quando o estado for “Publicado”.'),
                ])
                ->columns(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->wrap(),
                TextColumn::make('type')
                    ->label('Tipo')
                    ->badge()
                    ->formatStateUsing(fn (OralDefenseType $state): string => $state->label()),
                IconColumn::make('is_featured')
                    ->label('Principal')
                    ->boolean(),
                TextColumn::make('status')
                    ->label('Estado')
                    ->badge()
                    ->formatStateUsing(fn (OralDefenseStatus $state): string => $state->label())
                    ->color(fn (OralDefenseStatus $state): string => $state->color()),
                TextColumn::make('position')
                    ->label('Ordem')
                    ->sortable(),
                TextColumn::make('published_at')
                    ->label('Publicação')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('position')
            ->filters([
                SelectFilter::make('type')
                    ->label('Tipo')
                    ->options(self::typeOptions()),
                SelectFilter::make('status')
                    ->label('Estado')
                    ->options(self::statusOptions()),
            ])
            ->recordActions([
                EditAction::make()->label('Editar'),
                DeleteAction::make()->label('Excluir'),
            ])
            ->toolbarActions([])
            ->emptyStateHeading('Nenhuma sustentação ou defesa')
            ->emptyStateDescription('Adicione o primeiro conteúdo fictício ou autorizado.');
    }

    public static function getPages(): array
    {
        return [
            'index' => ListOralDefenses::route('/'),
            'create' => CreateOralDefense::route('/create'),
            'edit' => EditOralDefense::route('/{record}/edit'),
        ];
    }

    private static function typeOptions(): array
    {
        return collect(OralDefenseType::cases())
            ->mapWithKeys(fn (OralDefenseType $type): array => [$type->value => $type->label()])
            ->all();
    }

    private static function statusOptions(): array
    {
        return collect(OralDefenseStatus::cases())
            ->mapWithKeys(fn (OralDefenseStatus $status): array => [$status->value => $status->label()])
            ->all();
    }
}
