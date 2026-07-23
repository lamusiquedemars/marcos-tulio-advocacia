<?php

namespace App\Modules\Inquiries\Filament\Resources\Inquiries;

use App\Modules\Appointments\Enums\AppointmentStatus;
use App\Modules\Appointments\Models\AppointmentSetting;
use App\Modules\Audience\Actions\CreateContactFromInquiry;
use App\Modules\Inquiries\Enums\InquiryModality;
use App\Modules\Inquiries\Enums\InquiryPhase;
use App\Modules\Inquiries\Enums\InquiryRequestType;
use App\Modules\Inquiries\Enums\InquiryStatus;
use App\Modules\Inquiries\Enums\InquiryUrgency;
use App\Modules\Inquiries\Filament\Resources\Inquiries\Pages\ManageInquiries;
use App\Modules\Inquiries\Models\Inquiry;
use App\Modules\Inquiries\Support\InquiryReplyLink;
use App\Support\Modules;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema as SchemaFacade;
use UnitEnum;

class InquiryResource extends Resource
{
    protected static ?string $model = Inquiry::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedInbox;

    protected static ?string $navigationLabel = 'Solicitações recebidas';

    protected static UnitEnum|string|null $navigationGroup = 'Atendimento';

    protected static ?string $modelLabel = 'solicitação';

    protected static ?string $pluralModelLabel = 'solicitações';

    protected static ?int $navigationSort = 10;

    public static function shouldRegisterNavigation(): bool
    {
        return Modules::enabled('inquiries') && self::hasInquiriesTable();
    }

    public static function canAccess(): bool
    {
        return Modules::enabled('inquiries') && self::hasInquiriesTable() && parent::canAccess();
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Contato')
                    ->schema([
                        TextInput::make('name')->label('Nome')->required(),
                        TextInput::make('email')->label('Email')->email()->required(),
                        TextInput::make('phone')->label('Telefone')->tel(),
                        TextInput::make('location')->label('Cidade e estado'),
                    ])
                    ->columns(2),
                Section::make('Solicitação')
                    ->schema([
                        Select::make('request_type')
                            ->label('Tipo')
                            ->options(self::enumOptions(InquiryRequestType::cases())),
                        Select::make('urgency')
                            ->label('Urgência')
                            ->options(self::enumOptions(InquiryUrgency::cases())),
                        Select::make('phase')
                            ->label('Fase geral')
                            ->options(self::enumOptions(InquiryPhase::cases())),
                        DatePicker::make('deadline')
                            ->label('Data importante')
                            ->native(false),
                        Select::make('modality')
                            ->label('Modalidade')
                            ->options(self::enumOptions(InquiryModality::cases())),
                        Select::make('status')
                            ->label('Estado do acompanhamento')
                            ->options(self::statusOptions())
                            ->required(),
                        Textarea::make('message')
                            ->label('Resumo inicial')
                            ->required()
                            ->rows(7)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                Section::make('Acompanhamento interno')
                    ->schema([
                        Textarea::make('internal_notes')
                            ->label('Notas internas')
                            ->helperText('Nunca copie dados sensíveis para ferramentas de marketing.')
                            ->columnSpanFull(),
                        DateTimePicker::make('consent_at')->label('Consentimento registrado em')->disabled(),
                        TextInput::make('source')->label('Origem')->disabled(),
                        DateTimePicker::make('read_at')->label('Consultada em')->disabled(),
                        DateTimePicker::make('handled_at')->label('Agendada em')->disabled(),
                        DateTimePicker::make('archived_at')->label('Encerrada em')->disabled(),
                    ])
                    ->columns(2),
                Section::make('Agendamento')
                    ->description('O link do Brevo Meetings não recebe o resumo nem dados do caso.')
                    ->schema([
                        Select::make('appointment_status')
                            ->label('Estado do agendamento')
                            ->options(self::appointmentStatusOptions())
                            ->required(),
                        DateTimePicker::make('scheduled_start_at')
                            ->label('Início agendado')
                            ->timezone(fn (): string => AppointmentSetting::current()->timezone),
                        DateTimePicker::make('scheduled_end_at')
                            ->label('Fim agendado')
                            ->timezone(fn (): string => AppointmentSetting::current()->timezone),
                        TextInput::make('appointment_timezone')
                            ->label('Fuso do agendamento')
                            ->default('America/Cuiaba'),
                        TextInput::make('appointment_external_reference')
                            ->label('Referência externa')
                            ->helperText('Opcional. Não inserir link de videoconferência.')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query
                ->orderByRaw(
                    'case when status = ? then 0 when status = ? then 1 else 2 end',
                    [InquiryStatus::New->value, InquiryStatus::ToHandle->value]
                )
                ->latest()
            )
            ->columns([
                TextColumn::make('status')
                    ->label('Estado')
                    ->badge()
                    ->formatStateUsing(fn (InquiryStatus|string|null $state) => self::statusFrom($state)?->label() ?? '-')
                    ->color(fn (InquiryStatus|string|null $state) => self::statusFrom($state)?->color() ?? 'gray')
                    ->sortable(),
                TextColumn::make('name')
                    ->label('Nome')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                TextColumn::make('request_type')
                    ->label('Tipo')
                    ->formatStateUsing(fn (InquiryRequestType|string|null $state): string => self::enumLabel($state) ?? '-'),
                TextColumn::make('urgency')
                    ->label('Urgência')
                    ->badge()
                    ->formatStateUsing(fn (InquiryUrgency|string|null $state): string => self::enumLabel($state) ?? '-')
                    ->color(fn (InquiryUrgency|string|null $state): string => self::urgencyFrom($state)?->color() ?? 'gray'),
                TextColumn::make('deadline')
                    ->label('Data importante')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Recebida em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                TextColumn::make('read_at')
                    ->label('Consultada em')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('quick_view')
                    ->label('Visão rápida')
                    ->options([
                        'all' => 'Todas',
                        'priority' => 'Prioritárias',
                        'waiting_customer' => 'Consulta solicitada',
                        'closed' => 'Agendadas / encerradas',
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return match ($data['value'] ?? 'all') {
                            'waiting_customer' => $query->where('status', InquiryStatus::WaitingCustomer->value),
                            'closed' => $query->whereIn('status', [
                                InquiryStatus::Handled->value,
                                InquiryStatus::Archived->value,
                            ]),
                            'priority' => $query->whereIn('status', [
                                InquiryStatus::New->value,
                                InquiryStatus::ToHandle->value,
                            ]),
                            default => $query,
                        };
                    }),
                SelectFilter::make('status')
                    ->label('Estado')
                    ->options(self::statusOptions()),
            ])
            ->recordActions([
                Action::make('reply')
                    ->label('Responder')
                    ->icon(Heroicon::OutlinedEnvelope)
                    ->requiresConfirmation()
                    ->modalHeading('Abrir seu aplicativo de email?')
                    ->modalDescription('A solicitação passará para “Em contato”. Nenhum email é enviado automaticamente.')
                    ->action(function (Inquiry $record) {
                        $record->moveTo(InquiryStatus::ToHandle);

                        return redirect(self::mailtoUrl($record));
                    }),
                Action::make('createContact')
                    ->label('Criar contato')
                    ->icon(Heroicon::OutlinedUserPlus)
                    ->visible(fn (Inquiry $record): bool => self::canCreateAudienceContact() && filled($record->email))
                    ->action(function (Inquiry $record): void {
                        $result = CreateContactFromInquiry::run($record);

                        Notification::make()
                            ->title($result['created'] ? 'Contato criado' : 'Contato já existente')
                            ->body($result['contact']->email)
                            ->success()
                            ->send();
                    }),
                Action::make('openBooking')
                    ->label('Abrir agendamento')
                    ->icon(Heroicon::OutlinedCalendarDays)
                    ->visible(fn (): bool => self::appointmentBookingAvailable())
                    ->action(function (Inquiry $record) {
                        $setting = AppointmentSetting::current();
                        $record->update([
                            'appointment_status' => AppointmentStatus::BookingOpened,
                            'booking_opened_at' => now(),
                            'appointment_timezone' => $setting->timezone,
                        ]);

                        return redirect()->away($setting->booking_url);
                    }),
                ActionGroup::make([
                    Action::make('markRead')
                        ->label('Marcar como consultada')
                        ->icon(Heroicon::OutlinedEye)
                        ->visible(fn (Inquiry $record): bool => $record->read_at === null)
                        ->action(fn (Inquiry $record) => $record->markRead()),
                    Action::make('markToHandle')
                        ->label('Em contato')
                        ->icon(Heroicon::OutlinedExclamationCircle)
                        ->visible(fn (Inquiry $record): bool => $record->status !== InquiryStatus::ToHandle)
                        ->action(fn (Inquiry $record) => $record->moveTo(InquiryStatus::ToHandle)),
                    Action::make('markWaitingCustomer')
                        ->label('Consulta solicitada')
                        ->icon(Heroicon::OutlinedClock)
                        ->visible(fn (Inquiry $record): bool => $record->status !== InquiryStatus::WaitingCustomer)
                        ->action(fn (Inquiry $record) => $record->moveTo(InquiryStatus::WaitingCustomer)),
                    Action::make('markHandled')
                        ->label('Agendada')
                        ->icon(Heroicon::OutlinedCheckCircle)
                        ->visible(fn (Inquiry $record): bool => $record->status !== InquiryStatus::Handled)
                        ->action(fn (Inquiry $record) => $record->moveTo(InquiryStatus::Handled)),
                    Action::make('archive')
                        ->label('Encerrar')
                        ->icon(Heroicon::OutlinedArchiveBox)
                        ->visible(fn (Inquiry $record): bool => $record->status !== InquiryStatus::Archived)
                        ->action(fn (Inquiry $record) => $record->moveTo(InquiryStatus::Archived)),
                ])
                    ->label('Acompanhamento')
                    ->icon(Heroicon::OutlinedEllipsisVertical),
                EditAction::make()->label('Editar'),
                DeleteAction::make()->label('Excluir'),
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
            'index' => ManageInquiries::route('/'),
        ];
    }

    private static function statusOptions(): array
    {
        return collect(InquiryStatus::cases())
            ->mapWithKeys(fn (InquiryStatus $status) => [$status->value => $status->label()])
            ->all();
    }

    private static function enumOptions(array $cases): array
    {
        return collect($cases)
            ->mapWithKeys(fn ($case): array => [$case->value => $case->label()])
            ->all();
    }

    private static function enumLabel(object|string|null $state): ?string
    {
        if (is_object($state) && method_exists($state, 'label')) {
            return $state->label();
        }

        foreach ([InquiryRequestType::class, InquiryUrgency::class, InquiryPhase::class, InquiryModality::class] as $enum) {
            if (is_string($state) && ($case = $enum::tryFrom($state))) {
                return $case->label();
            }
        }

        return null;
    }

    private static function urgencyFrom(InquiryUrgency|string|null $urgency): ?InquiryUrgency
    {
        return $urgency instanceof InquiryUrgency ? $urgency : InquiryUrgency::tryFrom((string) $urgency);
    }

    private static function appointmentStatusOptions(): array
    {
        return collect(AppointmentStatus::cases())
            ->mapWithKeys(fn (AppointmentStatus $status): array => [$status->value => $status->label()])
            ->all();
    }

    private static function appointmentBookingAvailable(): bool
    {
        $setting = AppointmentSetting::current();

        return $setting->is_enabled && filled($setting->booking_url);
    }

    private static function mailtoUrl(Inquiry $record): string
    {
        return InquiryReplyLink::make($record);
    }

    private static function statusFrom(InquiryStatus|string|null $status): ?InquiryStatus
    {
        if ($status instanceof InquiryStatus) {
            return $status;
        }

        if (is_string($status)) {
            return InquiryStatus::tryFrom($status);
        }

        return null;
    }

    private static function hasInquiriesTable(): bool
    {
        return SchemaFacade::hasTable('inquiries');
    }

    private static function canCreateAudienceContact(): bool
    {
        return Modules::enabled('audience')
            && class_exists(CreateContactFromInquiry::class)
            && SchemaFacade::hasTable('audience_contacts');
    }
}
