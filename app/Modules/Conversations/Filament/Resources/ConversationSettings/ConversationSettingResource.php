<?php

namespace App\Modules\Conversations\Filament\Resources\ConversationSettings;

use App\Modules\Conversations\Filament\Resources\ConversationSettings\Pages\ManageConversationSettings;
use App\Modules\Conversations\Models\ConversationSetting;
use App\Support\Modules;
use BackedEnum;
use Filament\Actions\EditAction;
use Filament\Forms\Components\CheckboxList;
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
use Filament\Tables\Table;
use UnitEnum;

class ConversationSettingResource extends Resource
{
    protected static ?string $model = ConversationSetting::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChatBubbleLeftRight;

    protected static ?string $navigationLabel = 'Atendimento inicial';

    protected static UnitEnum|string|null $navigationGroup = 'Atendimento';

    protected static ?string $modelLabel = 'configuração do atendimento inicial';

    protected static ?string $pluralModelLabel = 'atendimento inicial';

    protected static ?int $navigationSort = 10;

    public static function shouldRegisterNavigation(): bool
    {
        return Modules::enabled('conversations');
    }

    public static function canAccess(): bool
    {
        return Modules::enabled('conversations') && parent::canAccess();
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Assistant')
                ->description('Defina o papel com campos orientados. As proteções essenciais permanecem obrigatórias.')
                ->schema([
                    Toggle::make('is_enabled')
                        ->label('Ativar o atendimento inicial'),
                    TextInput::make('widget_button_label')
                        ->label('Texto do botão')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('widget_title')
                        ->label('Título da janela')
                        ->required()
                        ->maxLength(255),
                    Textarea::make('privacy_notice')
                        ->label('Aviso exibido ao visitante')
                        ->rows(3)
                        ->maxLength(1000)
                        ->columnSpanFull(),
                    Select::make('assistant_language')
                        ->label('Idioma principal')
                        ->options([
                            'fr' => 'Français',
                            'en' => 'English',
                            'pt-BR' => 'Português (Brasil)',
                            'es' => 'Español',
                            'it' => 'Italiano',
                            'de' => 'Deutsch',
                        ])
                        ->searchable()
                        ->required(),
                    TextInput::make('assistant_tone')
                        ->label('Tom esperado')
                        ->required()
                        ->maxLength(255)
                        ->helperText('Por exemplo: claro, acolhedor e conciso.'),
                    Textarea::make('organization_summary')
                        ->label('Contexto da organização')
                        ->rows(4)
                        ->maxLength(3000)
                        ->helperText('Apresente a atividade, os serviços e os limites úteis para o encaminhamento.')
                        ->columnSpanFull(),
                ])
                ->columns(2),

            Section::make('Qualificação mínima')
                ->description('O assistente faz uma pergunta por vez e coleta somente o que é útil.')
                ->schema([
                    CheckboxList::make('qualification_fields')
                        ->label('Informações que o assistente pode solicitar')
                        ->options(ConversationSetting::QUALIFICATION_FIELDS)
                        ->columns(2)
                        ->columnSpanFull(),
                    Textarea::make('qualification_guidance')
                        ->label('Orientações de qualificação')
                        ->rows(3)
                        ->maxLength(2000),
                    Textarea::make('sensitive_data_guidance')
                        ->label('Outras informações que não devem ser solicitadas')
                        ->rows(3)
                        ->maxLength(2000),
                ])
                ->columns(2),

            Section::make('Orientation')
                ->description('O assistente reconhece o momento de propor os canais, mas a escolha permanece com o visitante.')
                ->schema([
                    CheckboxList::make('routing_triggers')
                        ->label('Quando propor um encaminhamento')
                        ->options(ConversationSetting::ROUTING_TRIGGERS)
                        ->columns(2)
                        ->columnSpanFull(),
                    Textarea::make('urgency_guidance')
                        ->label('Critérios de urgência do site')
                        ->rows(3)
                        ->maxLength(2000),
                    TextInput::make('expected_response_time')
                        ->label('Prazo de resposta que pode ser informado')
                        ->maxLength(255)
                        ->helperText('Por exemplo: durante o horário de atendimento ou em um dia útil.'),
                ])
                ->columns(2),

            Section::make('WhatsApp')
                ->schema([
                    Toggle::make('whatsapp_enabled')
                        ->label('Oferecer WhatsApp')
                        ->live(),
                    TextInput::make('whatsapp_number')
                        ->label('Número do WhatsApp')
                        ->tel()
                        ->maxLength(40)
                        ->helperText('Formato internacional, sem link ou texto.'),
                    Textarea::make('whatsapp_message_template')
                        ->label('Mensagem de passagem para o WhatsApp')
                        ->rows(3)
                        ->maxLength(1000)
                        ->helperText('Use {{reference}} para incluir a referência da conversa.')
                        ->columnSpanFull(),
                    Textarea::make('whatsapp_contact_message_template')
                        ->label('Mensagem usada pela equipe para contatar o visitante')
                        ->rows(3)
                        ->maxLength(1000)
                        ->helperText('Use {{reference}} para incluir a referência da conversa.')
                        ->columnSpanFull(),
                ])
                ->columns(2),

            Section::make('Solicitação de contato')
                ->schema([
                    Toggle::make('callback_enabled')
                        ->label('Permitir que o visitante solicite contato')
                        ->live(),
                    CheckboxList::make('callback_channels')
                        ->label('Canais oferecidos')
                        ->options(ConversationSetting::CALLBACK_CHANNELS)
                        ->columns(3)
                        ->columnSpanFull(),
                    TextInput::make('notification_email')
                        ->label('E-mail que recebe as novas solicitações')
                        ->email()
                        ->maxLength(255)
                        ->helperText('Se vazio, será usado o e-mail geral de contato do site.'),
                ]),

            Section::make('Instruções específicas')
                ->description('Complemento opcional. Não pode desativar as proteções universais.')
                ->schema([
                    Textarea::make('additional_instructions')
                        ->label('Instruções próprias deste site')
                        ->rows(5)
                        ->maxLength(4000),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                IconColumn::make('is_enabled')->label('Ativo')->boolean(),
                TextColumn::make('assistant_language')->label('Idioma'),
                IconColumn::make('whatsapp_enabled')->label('WhatsApp')->boolean(),
                IconColumn::make('callback_enabled')->label('Contato posterior')->boolean(),
            ])
            ->recordActions([
                EditAction::make()->label('Configurar'),
            ])
            ->toolbarActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageConversationSettings::route('/'),
        ];
    }
}
