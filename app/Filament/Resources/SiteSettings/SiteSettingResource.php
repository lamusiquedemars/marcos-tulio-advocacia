<?php

namespace App\Filament\Resources\SiteSettings;

use App\Filament\Resources\SiteSettings\Pages\ManageSiteSettings;
use App\Modules\Media\Filament\Forms\Components\MediaPicker;
use App\Modules\SiteSettings\Models\SiteSetting;
use App\Support\Modules;
use App\Support\PanelAccess;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class SiteSettingResource extends Resource
{
    protected static ?string $model = SiteSetting::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'Configurações';

    protected static UnitEnum|string|null $navigationGroup = 'Configurações';

    protected static ?string $modelLabel = 'configuração';

    protected static ?string $pluralModelLabel = 'configurações';

    protected static ?int $navigationSort = 90;

    public static function shouldRegisterNavigation(): bool
    {
        return Modules::enabled('site_settings');
    }

    public static function canAccess(): bool
    {
        return PanelAccess::administerSite() && Modules::enabled('site_settings') && parent::canAccess();
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('site_name')
                    ->label('Nome do site')
                    ->required()
                    ->default('Maracuja CMS'),
                TextInput::make('baseline')
                    ->label('Descrição curta'),
                TextInput::make('default_seo_title')
                    ->label('Título SEO padrão'),
                Textarea::make('default_seo_description')
                    ->label('Descrição SEO padrão')
                    ->columnSpanFull(),
                TextInput::make('contact_email')
                    ->label('Email de contato')
                    ->email(),
                Toggle::make('contact_form_send_admin_email')
                    ->label('Enviar uma notificação ao administrador')
                    ->default(true),
                Toggle::make('contact_form_send_confirmation_email')
                    ->label('Enviar uma confirmação ao visitante')
                    ->default(false),
                Toggle::make('contact_form_show_name')
                    ->label('Exibir o campo Nome')
                    ->default(true),
                Toggle::make('contact_form_show_phone')
                    ->label('Exibir o campo Telefone')
                    ->default(true),
                Toggle::make('contact_form_show_subject')
                    ->label('Exibir o campo Assunto')
                    ->default(true),
                TextInput::make('phone')
                    ->label('Telefone')
                    ->tel(),
                Textarea::make('address')
                    ->label('Endereço')
                    ->columnSpanFull(),
                MediaPicker::make('logo_media_id')
                    ->label('Logo')
                    ->relationship('logoMedia', 'display_name')
                    ->imagesOnly(),
                MediaPicker::make('favicon_media_id')
                    ->label('Favicon')
                    ->relationship('faviconMedia', 'display_name')
                    ->imagesOnly(),
                MediaPicker::make('default_og_media_id')
                    ->label('Imagem social padrão')
                    ->helperText('Imagem usada pelo Open Graph quando o conteúdo não fornece outra.')
                    ->relationship('defaultOgMedia', 'display_name')
                    ->imagesOnly(),
                KeyValue::make('social_links')
                    ->label('Links sociais')
                    ->keyLabel('Nome')
                    ->valueLabel('URL')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('site_name')
                    ->label('Nome')
                    ->searchable(),
                TextColumn::make('baseline')
                    ->searchable(),
                TextColumn::make('default_seo_title')
                    ->searchable(),
                TextColumn::make('contact_email')
                    ->label('Email')
                    ->searchable(),
                TextColumn::make('phone')
                    ->searchable(),
                TextColumn::make('logo_path')
                    ->searchable(),
                TextColumn::make('favicon_path')
                    ->searchable(),
                TextColumn::make('default_og_image_path')
                    ->label('Imagem social')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageSiteSettings::route('/'),
        ];
    }
}
