<?php

namespace App\Modules\Conversations\Filament\Resources\Conversations\Pages;

use App\Modules\Conversations\Actions\AddMessage;
use App\Modules\Conversations\Enums\ConversationStatus;
use App\Modules\Conversations\Enums\HandoverReason;
use App\Modules\Conversations\Enums\MessageAuthorType;
use App\Modules\Conversations\Enums\MessageVisibility;
use App\Modules\Conversations\Filament\Resources\Conversations\ConversationResource;
use App\Modules\Conversations\Support\WhatsAppHandoverLink;
use Filament\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;

class ViewConversation extends ViewRecord
{
    protected static string $resource = ConversationResource::class;

    protected string $view = 'filament.conversations.view';

    protected function getHeaderActions(): array
    {
        return [
            Action::make('takeOver')
                ->label(fn (): string => WhatsAppHandoverLink::makeForContact($this->record)
                    ? 'Assumir e abrir WhatsApp'
                    : 'Assumir atendimento')
                ->visible(fn (): bool => ! in_array($this->record->status, [
                    ConversationStatus::HumanActive,
                    ConversationStatus::Closed,
                    ConversationStatus::Archived,
                ], true))
                ->action(function () {
                    $this->record->update([
                        'assigned_user_id' => auth()->id(),
                        'status' => ConversationStatus::HumanActive,
                        'ai_enabled' => false,
                        'human_handover_at' => $this->record->human_handover_at ?? now(),
                        'handover_reason' => $this->record->handover_reason ?? HandoverReason::Manual,
                    ]);

                    Notification::make()->title('Atendimento assumido')->success()->send();

                    $whatsappUrl = WhatsAppHandoverLink::makeForContact($this->record->fresh('contact'));

                    if ($whatsappUrl) {
                        return redirect()->away($whatsappUrl);
                    }

                    Notification::make()
                        ->title('Número do visitante não informado')
                        ->body('O atendimento foi assumido, mas não há um número para abrir no WhatsApp.')
                        ->warning()
                        ->send();
                }),
            Action::make('internalNote')
                ->label('Adicionar nota interna')
                ->schema([
                    Textarea::make('content')
                        ->label('Nota interna')
                        ->required()
                        ->maxLength(5000),
                ])
                ->action(function (array $data): void {
                    AddMessage::run(
                        $this->record,
                        $data['content'],
                        MessageAuthorType::Human,
                        MessageVisibility::Internal,
                        auth()->user(),
                    );

                    Notification::make()->title('Nota interna adicionada')->success()->send();
                }),
            Action::make('whatsapp')
                ->label('Contatar pelo WhatsApp')
                ->url(fn (): ?string => WhatsAppHandoverLink::makeForContact($this->record))
                ->openUrlInNewTab()
                ->visible(fn (): bool => WhatsAppHandoverLink::makeForContact($this->record) !== null),
            Action::make('close')
                ->label('Encerrar')
                ->color('gray')
                ->requiresConfirmation()
                ->visible(fn (): bool => $this->record->status !== ConversationStatus::Closed)
                ->action(function (): void {
                    $this->record->update([
                        'status' => ConversationStatus::Closed,
                        'ai_enabled' => false,
                        'closed_at' => now(),
                    ]);

                    Notification::make()->title('Conversa encerrada')->success()->send();
                }),
        ];
    }
}
