<?php

namespace App\Modules\OralDefenses\Models;

use App\Modules\Media\Concerns\TracksMediaUsages;
use App\Modules\Media\Models\MediaAsset;
use App\Modules\OralDefenses\Enums\OralDefenseStatus;
use App\Modules\OralDefenses\Enums\OralDefenseType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Validation\ValidationException;

class OralDefense extends Model
{
    use TracksMediaUsages;

    public const MAX_PUBLISHED_SECONDARY_VIDEOS = 6;

    protected $fillable = [
        'type',
        'title',
        'context',
        'video_url',
        'video_media_id',
        'thumbnail_media_id',
        'initial_situation',
        'legal_question',
        'strategy',
        'intervention',
        'is_anonymized',
        'is_featured',
        'status',
        'position',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'type' => OralDefenseType::class,
            'status' => OralDefenseStatus::class,
            'is_anonymized' => 'boolean',
            'is_featured' => 'boolean',
            'position' => 'integer',
            'published_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (self $record): void {
            $record->validatePublicationRules();
        });
    }

    public function videoMedia(): BelongsTo
    {
        return $this->belongsTo(MediaAsset::class, 'video_media_id');
    }

    public function thumbnailMedia(): BelongsTo
    {
        return $this->belongsTo(MediaAsset::class, 'thumbnail_media_id');
    }

    public function videoSource(): ?string
    {
        return $this->trackedMedia('videoMedia', $this->video_media_id)?->publicPath()
            ?? $this->video_url;
    }

    public function posterUrl(): ?string
    {
        return $this->trackedMedia('thumbnailMedia', $this->thumbnail_media_id)?->publicPath()
            ?? $this->trackedMedia('videoMedia', $this->video_media_id)?->thumbnailUrl();
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query
            ->where('status', OralDefenseStatus::Published)
            ->where(function (Builder $query): void {
                $query->whereNull('published_at')->orWhere('published_at', '<=', now());
            });
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('position')->orderBy('id');
    }

    protected function mediaUsageReferences(): array
    {
        return [
            ['media_asset_id' => $this->video_media_id, 'field' => 'video_media_id'],
            ['media_asset_id' => $this->thumbnail_media_id, 'field' => 'thumbnail_media_id'],
        ];
    }

    private function validatePublicationRules(): void
    {
        if ($this->status !== OralDefenseStatus::Published) {
            return;
        }

        if ($this->type === OralDefenseType::Defense && ! $this->is_anonymized) {
            throw ValidationException::withMessages([
                'is_anonymized' => 'Confirme a anonimização antes de publicar este exemplo de defesa.',
            ]);
        }

        if ($this->type !== OralDefenseType::Video) {
            $this->is_featured = false;

            return;
        }

        if (blank($this->video_url) && blank($this->video_media_id)) {
            throw ValidationException::withMessages([
                'video_url' => 'Informe um link ou selecione um vídeo da biblioteca antes de publicar.',
            ]);
        }

        $query = self::query()
            ->where('type', OralDefenseType::Video)
            ->where('status', OralDefenseStatus::Published)
            ->when($this->exists, fn (Builder $query): Builder => $query->whereKeyNot($this->getKey()));

        if ($this->is_featured && (clone $query)->where('is_featured', true)->exists()) {
            throw ValidationException::withMessages([
                'is_featured' => 'Já existe um vídeo principal publicado. Arquive ou retire o destaque atual antes de continuar.',
            ]);
        }

        if (! $this->is_featured && (clone $query)->where('is_featured', false)->count() >= self::MAX_PUBLISHED_SECONDARY_VIDEOS) {
            throw ValidationException::withMessages([
                'status' => 'O limite de seis vídeos secundários publicados foi atingido. Arquive ou despublique um conteúdo antes de continuar.',
            ]);
        }
    }
}
