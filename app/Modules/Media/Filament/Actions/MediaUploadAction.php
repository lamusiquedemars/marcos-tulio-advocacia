<?php

namespace App\Modules\Media\Filament\Actions;

use App\Models\User;
use App\Modules\Media\Enums\MediaType;
use App\Modules\Media\Services\MediaStorageService;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class MediaUploadAction
{
    public static function make(?MediaType $type = null): Action
    {
        $acceptedFileTypes = match ($type) {
            MediaType::Image => ['image/jpeg', 'image/png', 'image/webp'],
            MediaType::Document => ['application/pdf'],
            MediaType::Video => ['video/mp4', 'video/webm'],
            null => ['image/jpeg', 'image/png', 'image/webp', 'application/pdf', 'video/mp4', 'video/webm'],
        };
        $maximumSize = (int) config(match ($type) {
            MediaType::Image => 'maracuja.media.image_max_size_kb',
            MediaType::Document => 'maracuja.media.document_max_size_kb',
            MediaType::Video => 'maracuja.media.video_max_size_kb',
            null => 'maracuja.media.video_max_size_kb',
        });

        return Action::make('uploadMedia')
            ->label('Importar do computador')
            ->icon(Heroicon::OutlinedArrowUpTray)
            ->modalHeading('Importar do computador')
            ->modalDescription(self::description($type))
            ->form([
                FileUpload::make('files')
                    ->label('Arquivos')
                    ->multiple()
                    ->storeFiles(false)
                    ->acceptedFileTypes($acceptedFileTypes)
                    ->maxSize($maximumSize)
                    ->required(),
            ])
            ->action(function (array $data, MediaStorageService $storage): void {
                $files = collect($data['files'] ?? [])
                    ->filter(fn (mixed $file): bool => $file instanceof TemporaryUploadedFile);

                /** @var User|null $uploader */
                $uploader = auth()->user();

                $files->each(fn (TemporaryUploadedFile $file) => $storage->store($file, uploader: $uploader));

                Notification::make()
                    ->title($files->count().' mídia'.($files->count() > 1 ? 's adicionadas' : ' adicionada'))
                    ->success()
                    ->send();
            });
    }

    private static function description(?MediaType $type): string
    {
        return match ($type) {
            MediaType::Image => 'Imagens JPEG, PNG ou WebP, 5 MB no máximo.',
            MediaType::Document => 'Documentos PDF, 15 MB no máximo.',
            MediaType::Video => 'Vídeos MP4 ou WebM, 100 MB no máximo.',
            null => 'Imagens JPEG, PNG ou WebP, documentos PDF e vídeos MP4 ou WebM.',
        };
    }
}
