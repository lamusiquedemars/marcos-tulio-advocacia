<?php

namespace App\Providers;

use App\Modules\Assistant\Contracts\AssistantProvider;
use App\Modules\Assistant\Providers\FakeAssistantProvider;
use App\Modules\Media\Models\MediaAsset;
use App\Modules\Media\Policies\MediaAssetPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AssistantProvider::class, function (): AssistantProvider {
            return match (config('maracuja.assistant.provider')) {
                'fake' => new FakeAssistantProvider,
                default => throw new \InvalidArgumentException('O provedor configurado para o assistente não está disponível.'),
            };
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $moduleMigrationPaths = [
            app_path('Modules/Inquiries/database/migrations'),
            app_path('Modules/Audience/database/migrations'),
            app_path('Modules/Media/database/migrations'),
            app_path('Modules/Appointments/database/migrations'),
        ];

        foreach ($moduleMigrationPaths as $path) {
            if (is_dir($path)) {
                $this->loadMigrationsFrom($path);
            }
        }

        Gate::policy(MediaAsset::class, MediaAssetPolicy::class);
    }
}
