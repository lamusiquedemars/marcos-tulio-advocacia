<?php

namespace App\Providers;

use App\Models\User;
use App\Modules\Appointments\Models\AppointmentSetting;
use App\Modules\Assistant\Contracts\AssistantProvider;
use App\Modules\Assistant\Providers\FakeAssistantProvider;
use App\Modules\Audience\Models\AudienceBrevoSetting;
use App\Modules\Conversations\Console\Commands\PruneConversationsCommand;
use App\Modules\Conversations\Models\Conversation;
use App\Modules\Conversations\Models\ConversationSetting;
use App\Modules\Conversations\Policies\ConversationPolicy;
use App\Modules\Media\Models\MediaAsset;
use App\Modules\Media\Policies\MediaAssetPolicy;
use App\Modules\SiteSettings\Models\SiteSetting;
use App\Support\ContentPermissions;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Maracuja\SiteCore\Assistant\Contracts\AssistantAiProvider;
use Maracuja\SiteCore\Assistant\Providers\FakeAssistantAiProvider;
use Maracuja\SiteCore\Assistant\Providers\OpenAiAssistantProvider;
use RuntimeException;

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

        $this->app->bind(AssistantAiProvider::class, function (): AssistantAiProvider {
            return match (config('maracuja.conversations.ai.provider')) {
                'fake' => new FakeAssistantAiProvider,
                'openai' => new OpenAiAssistantProvider,
                default => throw new \InvalidArgumentException('O provedor de IA configurado não está disponível.'),
            };
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->guardTestingDatabase();

        $this->commands([
            PruneConversationsCommand::class,
        ]);

        $moduleMigrationPaths = [
            app_path('Modules/Inquiries/database/migrations'),
            app_path('Modules/Audience/database/migrations'),
            app_path('Modules/Media/database/migrations'),
            app_path('Modules/Appointments/database/migrations'),
            app_path('Modules/Contacts/database/migrations'),
            app_path('Modules/Conversations/database/migrations'),
        ];

        foreach ($moduleMigrationPaths as $path) {
            if (is_dir($path)) {
                $this->loadMigrationsFrom($path);
            }
        }

        Gate::policy(MediaAsset::class, MediaAssetPolicy::class);
        Gate::policy(Conversation::class, ConversationPolicy::class);

        Gate::before(function (User $user, string $ability, array $arguments): ?bool {
            $subject = $arguments[0] ?? null;
            $subjectClass = is_object($subject) ? $subject::class : $subject;

            if (! $user->isAdministrator() && in_array($subjectClass, [User::class, SiteSetting::class, AudienceBrevoSetting::class, AppointmentSetting::class, ConversationSetting::class], true)) {
                return false;
            }

            if (! ContentPermissions::allows($user, $subjectClass)) {
                return false;
            }

            if (! $subjectClass || Gate::getPolicyFor($subjectClass)) {
                return null;
            }

            return true;
        });
    }

    private function guardTestingDatabase(): void
    {
        if (! $this->app->environment('testing')) {
            return;
        }

        $connection = (string) config('database.default');
        $database = (string) config("database.connections.{$connection}.database");

        if ($database === ':memory:' || str_ends_with($database, '_testing')) {
            return;
        }

        throw new RuntimeException(
            "Tests blocked: database [{$database}] is not a dedicated testing database. "
            .'Use a database name ending in [_testing].'
        );
    }
}
