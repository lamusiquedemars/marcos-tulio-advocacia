<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_filament_login_page_is_available(): void
    {
        $this->get('/admin/login')->assertOk();
    }

    public function test_admin_user_can_access_panel(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $this->actingAs($admin)
            ->get('/admin')
            ->assertOk();
    }

    public function test_non_admin_user_cannot_access_panel(): void
    {
        $user = User::factory()->create(['is_admin' => false]);

        $this->actingAs($user)
            ->get('/admin')
            ->assertForbidden();
    }

    public function test_content_editor_can_access_panel_and_editorial_pages(): void
    {
        $editor = User::factory()->create([
            'is_admin' => false,
            'role' => User::ROLE_CONTENT_EDITOR,
        ]);

        $this->actingAs($editor)
            ->get('/admin')
            ->assertOk();

        $this->actingAs($editor)
            ->get('/admin/pages')
            ->assertOk();
    }

    public function test_content_editor_cannot_access_sensitive_resources(): void
    {
        $editor = User::factory()->create([
            'is_admin' => false,
            'role' => User::ROLE_CONTENT_EDITOR,
        ]);

        foreach (['/admin/inquiries', '/admin/site-settings', '/admin/contacts', '/admin/conversations'] as $path) {
            $this->actingAs($editor)->get($path)->assertForbidden();
        }
    }

    public function test_admin_user_can_open_portuguese_inquiries_resource(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $this->actingAs($admin)
            ->get('/admin/inquiries')
            ->assertOk()
            ->assertSee('Solicitações recebidas');
    }
}
