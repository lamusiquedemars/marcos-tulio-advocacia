<?php

namespace Tests\Feature\OralDefenses;

use App\Modules\OralDefenses\Enums\OralDefenseStatus;
use App\Modules\OralDefenses\Enums\OralDefenseType;
use App\Modules\OralDefenses\Models\OralDefense;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class OralDefenseTest extends TestCase
{
    use RefreshDatabase;

    public function test_only_one_published_video_can_be_featured(): void
    {
        $this->video(['title' => 'Principal', 'is_featured' => true]);

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Já existe um vídeo principal publicado');

        $this->video(['title' => 'Outro principal', 'is_featured' => true]);
    }

    public function test_up_to_six_secondary_videos_can_be_published(): void
    {
        foreach (range(1, OralDefense::MAX_PUBLISHED_SECONDARY_VIDEOS) as $position) {
            $this->video(['title' => "Secundário {$position}", 'position' => $position]);
        }

        $this->assertSame(6, OralDefense::query()->count());

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('O limite de seis vídeos secundários publicados foi atingido');

        $this->video(['title' => 'Sétimo secundário', 'position' => 7]);
    }

    public function test_archiving_a_secondary_video_frees_a_publication_slot(): void
    {
        foreach (range(1, 6) as $position) {
            $this->video(['title' => "Secundário {$position}", 'position' => $position]);
        }

        OralDefense::query()->firstOrFail()->update(['status' => OralDefenseStatus::Archived]);

        $replacement = $this->video(['title' => 'Novo secundário']);

        $this->assertSame(OralDefenseStatus::Published, $replacement->status);
        $this->assertDatabaseCount('oral_defenses', 7);
    }

    public function test_a_defense_example_must_be_anonymized_before_publication(): void
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Confirme a anonimização');

        OralDefense::query()->create([
            'type' => OralDefenseType::Defense,
            'title' => 'Exemplo não anonimizado',
            'status' => OralDefenseStatus::Published,
            'is_anonymized' => false,
        ]);
    }

    public function test_a_published_video_requires_a_link_or_media(): void
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Informe um link ou selecione um vídeo');

        $this->video(['title' => 'Sem fonte', 'video_url' => null]);
    }

    public function test_public_page_renders_only_published_selection(): void
    {
        $this->seed();

        $this->video([
            'title' => 'Sustentação pública fictícia',
            'is_featured' => true,
        ]);
        OralDefense::query()->create([
            'type' => OralDefenseType::Defense,
            'title' => 'Defesa pública fictícia',
            'context' => 'Conteúdo demonstrativo.',
            'is_anonymized' => true,
            'status' => OralDefenseStatus::Published,
        ]);
        OralDefense::query()->create([
            'type' => OralDefenseType::Defense,
            'title' => 'Defesa arquivada invisível',
            'is_anonymized' => true,
            'status' => OralDefenseStatus::Archived,
        ]);

        $this->get('/sustentacoes-e-defesas')
            ->assertOk()
            ->assertSee('Sustentação pública fictícia')
            ->assertSee('Defesa pública fictícia')
            ->assertDontSee('Defesa arquivada invisível');
    }

    private function video(array $attributes = []): OralDefense
    {
        return OralDefense::query()->create(array_merge([
            'type' => OralDefenseType::Video,
            'title' => 'Vídeo fictício',
            'video_url' => 'https://example.test/video-demo',
            'status' => OralDefenseStatus::Published,
            'is_featured' => false,
            'position' => 0,
        ], $attributes));
    }
}
