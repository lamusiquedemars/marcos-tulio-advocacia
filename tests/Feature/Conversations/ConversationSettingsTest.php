<?php

namespace Tests\Feature\Conversations;

use App\Modules\Conversations\Models\ConversationSetting;
use App\Modules\Conversations\Services\ConversationInstructionsBuilder;
use App\Modules\SiteSettings\Models\SiteSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class ConversationSettingsTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_site_starts_with_its_business_configuration(): void
    {
        $settings = ConversationSetting::current();

        $this->assertTrue($settings->is_enabled);
        $this->assertSame('pt-BR', $settings->assistant_language);
        $this->assertContains('deadline', $settings->qualification_fields);
        $this->assertTrue($settings->whatsapp_enabled);
        $this->assertSame('+5565992830446', $settings->whatsapp_number);
        $this->assertTrue($settings->callback_enabled);
        $this->assertSame(12, $settings->max_visitor_messages);
        $this->assertSame(10, $settings->warning_at_message);
        $this->assertStringContainsString('Marcos Túlio Advocacia', $settings->welcome_message);
        $this->assertStringContainsString('Marcos Túlio Advocacia', $settings->organization_summary);
        $this->assertDatabaseCount('conversation_settings', 1);
    }

    public function test_the_prompt_combines_guardrails_with_site_configuration(): void
    {
        $site = SiteSetting::current();
        $site->update(['site_name' => 'Marcos Túlio Advocacia']);
        $settings = ConversationSetting::current();
        $instructions = app(ConversationInstructionsBuilder::class)->build($settings, $site);

        $this->assertStringContainsString('Marcos Túlio Advocacia', $instructions);
        $this->assertStringContainsString('prisão ou pessoa detida', $instructions);
        $this->assertStringContainsString('a later contact request', $instructions);
        $this->assertStringContainsString('The visitor chooses the contact channel', $instructions);
        $this->assertStringContainsString('offer_contact_options', $instructions);
    }

    public function test_enabled_channels_require_their_minimum_configuration(): void
    {
        $this->expectException(ValidationException::class);

        ConversationSetting::current()->update([
            'whatsapp_enabled' => true,
            'whatsapp_number' => null,
        ]);
    }
}
