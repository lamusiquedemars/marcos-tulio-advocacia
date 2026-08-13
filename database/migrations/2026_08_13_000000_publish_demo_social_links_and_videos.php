<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    private const USABLE_TYPE = 'App\\Modules\\OralDefenses\\Models\\OralDefense';

    public function up(): void
    {
        $this->publishSocialLinks();

        foreach ($this->videos() as $position => $video) {
            $mediaId = $this->upsertMedia($video['media']);

            DB::table('oral_defenses')->updateOrInsert(
                ['title' => $video['title']],
                [
                    'type' => 'video',
                    'context' => $video['context'],
                    'video_url' => null,
                    'video_media_id' => $mediaId,
                    'thumbnail_media_id' => null,
                    'initial_situation' => null,
                    'legal_question' => null,
                    'strategy' => null,
                    'intervention' => null,
                    'is_anonymized' => false,
                    'is_featured' => $video['featured'],
                    'status' => 'published',
                    'position' => $position,
                    'published_at' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            );

            $defenseId = DB::table('oral_defenses')->where('title', $video['title'])->value('id');

            DB::table('media_usages')->updateOrInsert(
                [
                    'usable_type' => self::USABLE_TYPE,
                    'usable_id' => $defenseId,
                    'field' => 'video_media_id',
                ],
                [
                    'media_asset_id' => $mediaId,
                    'context' => '',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            );
        }
    }

    public function down(): void
    {
        $titles = array_column($this->videos(), 'title');
        $defenseIds = DB::table('oral_defenses')->whereIn('title', $titles)->pluck('id');

        DB::table('media_usages')
            ->where('usable_type', self::USABLE_TYPE)
            ->whereIn('usable_id', $defenseIds)
            ->delete();

        DB::table('oral_defenses')->whereIn('id', $defenseIds)->delete();
    }

    private function publishSocialLinks(): void
    {
        $settings = DB::table('site_settings')->first();

        if (! $settings) {
            return;
        }

        $links = json_decode($settings->social_links ?: '{}', true) ?: [];
        $links['facebook'] = 'https://www.facebook.com/profmarcostulio/';
        $links['instagram'] = 'https://www.instagram.com/marcostuliodmelo/';

        DB::table('site_settings')->where('id', $settings->id)->update([
            'social_links' => json_encode($links, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
            'updated_at' => now(),
        ]);
    }

    private function upsertMedia(array $media): int
    {
        DB::table('media_assets')->updateOrInsert(
            ['checksum' => $media['checksum']],
            $media + [
                'type' => 'video',
                'disk' => 'public',
                'width' => null,
                'height' => null,
                'alt_text' => null,
                'caption' => null,
                'credit' => null,
                'uploaded_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        );

        return (int) DB::table('media_assets')->where('checksum', $media['checksum'])->value('id');
    }

    private function videos(): array
    {
        return [
            [
                'title' => 'Sustentação em habeas corpus',
                'context' => 'Trecho final de uma sustentação oral em habeas corpus perante o Tribunal de Justiça do Mato Grosso, em favor de um policial militar.',
                'featured' => true,
                'media' => [
                    'path' => 'media/videos/2026/08/01KYZHYCVJKJMX0RDQRTWXNYGX.mp4',
                    'thumbnail_path' => 'media/video-thumbnails/2026/08/01KYZM598FPRRVD9HZKHTWGKSP.jpg',
                    'original_name' => 'mta-sustentacao-habeas.mp4',
                    'display_name' => 'mta-sustentacao-habeas',
                    'mime_type' => 'video/mp4',
                    'extension' => 'mp4',
                    'size' => 5459511,
                    'checksum' => 'de14e93ccb4bb6abc070a3ed8a9f38c136e8b52fbda072de3b14538fc9dfe070',
                ],
            ],
            [
                'title' => 'Sustentação oral contra prisão preventiva',
                'context' => 'Sustentacao oral atacando uma prisão preventiva, baseada na garantia da ordem pública.',
                'featured' => false,
                'media' => [
                    'path' => 'media/videos/2026/08/01KYZHYPY3ETD4QY1H2NZ42GC0.mp4',
                    'thumbnail_path' => 'media/video-thumbnails/2026/08/01KYZM59A02WMTX5RV4E1ABK6R.jpg',
                    'original_name' => 'mta-sustentacao-oral.mp4',
                    'display_name' => 'mta-sustentacao-oral',
                    'mime_type' => 'video/mp4',
                    'extension' => 'mp4',
                    'size' => 3957386,
                    'checksum' => '7ef2fb5ea27f71613750c9de26a74334e119367980124daf9f33696079a326d5',
                ],
            ],
            [
                'title' => 'Estilo de sustentação com firmeza',
                'context' => 'Apresentando com firmeza e contundência aos desembargadores, dentro do meu estilo com seriedade.',
                'featured' => false,
                'media' => [
                    'path' => 'media/videos/2026/08/01KYZHY3T2A9KN9QE9TY2HKCRE.mp4',
                    'thumbnail_path' => 'media/video-thumbnails/2026/08/01KYZM59707PJ8F5TB1XWZ083G.jpg',
                    'original_name' => 'mta-estilo-firmeza.mp4',
                    'display_name' => 'mta-estilo-firmeza',
                    'mime_type' => 'video/mp4',
                    'extension' => 'mp4',
                    'size' => 4392602,
                    'checksum' => '61634a5fa2888c62ab5101fdeff1b2f4008676e6a92533f4e5030956504e74ab',
                ],
            ],
            [
                'title' => 'Sustentação - destruindo nulidades',
                'context' => 'Sustentaçao oral - destruidor de nulidades em defesa.',
                'featured' => false,
                'media' => [
                    'path' => 'media/videos/2026/08/01KYZHXSGHSQT7RN6V07RQ8YZF.mp4',
                    'thumbnail_path' => 'media/video-thumbnails/2026/08/01KYZM595MFRYY3DGWN1PYX9CW.jpg',
                    'original_name' => 'mta-destruidor-nulidades.mp4',
                    'display_name' => 'mta-destruidor-nulidades',
                    'mime_type' => 'video/mp4',
                    'extension' => 'mp4',
                    'size' => 7106006,
                    'checksum' => 'c7afd5d2021bf5298068988eadb3556c8b8457c5e879d347850ff6284c2e3cc4',
                ],
            ],
            [
                'title' => 'Considerações sobre dinâmica de leitura de votos',
                'context' => 'Momentos em que manifesto minha opinião sobre a dinâmica de leitura de votos.',
                'featured' => false,
                'media' => [
                    'path' => 'media/videos/2026/08/01KYZHWNS0GCX94SSQ60VXCQ15.mp4',
                    'thumbnail_path' => 'media/video-thumbnails/2026/08/01KYZM591BA73GXC9P11XF94SS.jpg',
                    'original_name' => 'mta-defesas-criminal.mp4',
                    'display_name' => 'mta-defesas-criminal',
                    'mime_type' => 'video/mp4',
                    'extension' => 'mp4',
                    'size' => 3469859,
                    'checksum' => 'a8bda7f1e94eb0048376280bcbef8bc76262011ef8c201e678beac098af86fc9',
                ],
            ],
            [
                'title' => 'Desembargador elogia minha defesa',
                'context' => 'Desembargador parabeniza a sustentação oral em defesa de um cliente, considerando-a brilhante.',
                'featured' => false,
                'media' => [
                    'path' => 'media/videos/2026/08/01KYZHXE0SHVVHF100XPNPJFGG.mp4',
                    'thumbnail_path' => 'media/video-thumbnails/2026/08/01KYZM5944QP2E7087S0BERGTG.jpg',
                    'original_name' => 'mta-desembargador-elogio.mp4',
                    'display_name' => 'mta-desembargador-elogio',
                    'mime_type' => 'video/mp4',
                    'extension' => 'mp4',
                    'size' => 2077952,
                    'checksum' => 'fc1eb8655898c8c0c49758e89f001c4041a8e764e12fa1429bf22caf5ce41cd9',
                ],
            ],
        ];
    }
};
