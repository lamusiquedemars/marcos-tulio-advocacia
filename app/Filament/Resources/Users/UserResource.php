<?php

namespace App\Filament\Resources\Users;

use App\Filament\Resources\Users\Pages\CreateUser;
use App\Filament\Resources\Users\Pages\EditUser;
use App\Filament\Resources\Users\Pages\ListUsers;
use App\Models\User;
use App\Support\ContentPermissions;
use Filament\Actions\EditAction;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;

    protected static ?string $navigationLabel = 'Usuários';

    protected static \UnitEnum|string|null $navigationGroup = 'Configurações';

    protected static ?string $modelLabel = 'usuário';

    protected static ?string $pluralModelLabel = 'usuários';

    protected static ?int $navigationSort = 95;

    public static function canAccess(): bool
    {
        return auth()->user()?->isAdministrator() ?? false;
    }

    public static function canViewAny(): bool
    {
        return static::canAccess();
    }

    public static function canCreate(): bool
    {
        return static::canAccess();
    }

    public static function canEdit($record): bool
    {
        return static::canAccess();
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')
                ->label('Nome')
                ->required()
                ->maxLength(255),
            TextInput::make('email')
                ->label('Email')
                ->email()
                ->required()
                ->unique(ignoreRecord: true)
                ->maxLength(255),
            Select::make('role')
                ->label('Perfil')
                ->options([
                    User::ROLE_ADMIN => 'Administrador Maracuja',
                    User::ROLE_MANAGER => 'Responsável pelo atendimento',
                    User::ROLE_EDITOR => 'Editor de conteúdo',
                ])
                ->default(User::ROLE_EDITOR)
                ->required()
                ->helperText('O administrador Maracuja gerencia contas e configurações internas. Os demais perfis acessam as funções atribuídas.'),
            Select::make('access_scope')
                ->label('Acesso às funções')
                ->options(['selected' => 'Funções selecionadas', 'all' => 'Acesso conforme o perfil existente'])
                ->default('selected')
                ->required()
                ->live()
                ->dehydrated(),
            CheckboxList::make('content_permissions')
                ->label('Funções acessíveis')
                ->options(ContentPermissions::labelsForForm())
                ->columns(2)
                ->default([])
                ->visible(fn (Get $get): bool => $get('access_scope') === 'selected')
                ->helperText('Selecione as funções acessíveis a esta pessoa. Administradores mantêm todos os acessos.'),
            Toggle::make('is_active')->label('Conta ativa')->default(true),
            TextInput::make('password')
                ->label('Senha')
                ->password()
                ->revealable()
                ->required(fn (string $operation): bool => $operation === 'create')
                ->dehydrated(fn ($state): bool => filled($state))
                ->minLength(8)
                ->helperText('Deixe em branco para manter a senha atual.'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nome')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('role')
                    ->label('Perfil')
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        User::ROLE_ADMIN => 'Administrador',
                        User::ROLE_MANAGER => 'Responsável pelo atendimento',
                        User::ROLE_EDITOR => 'Editor de conteúdo',
                        default => 'Não definido',
                    })
                    ->badge()
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->label('Última alteração')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('name')
            ->recordActions([
                EditAction::make()->label('Editar'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'edit' => EditUser::route('/{record}/edit'),
        ];
    }
}
