<?php

namespace Tests\Feature;

use App\Filament\Resources\Users\Pages\EditUser;
use App\Models\User;
use App\Modules\Contacts\Models\Contact;
use App\Modules\News\Models\NewsPost;
use App\Modules\Notices\Models\SiteNotice;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Livewire\Livewire;
use Tests\TestCase;

class ContentPermissionsTest extends TestCase
{
    use RefreshDatabase;

    public function test_legacy_client_manager_keeps_client_access_without_content_access(): void
    {
        $user = User::factory()->create(['role' => User::ROLE_CLIENT_MANAGER, 'is_admin' => false, 'content_permissions' => null]);
        $this->assertTrue(Gate::forUser($user)->allows('viewAny', Contact::class));
        $this->assertFalse(Gate::forUser($user)->allows('viewAny', NewsPost::class));
        $this->actingAs($user)->get('/admin/users')->assertForbidden();
    }

    public function test_administrator_can_select_functions_across_legacy_role_groups(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $user = User::factory()->create(['role' => User::ROLE_CLIENT_MANAGER, 'is_admin' => false, 'content_permissions' => null]);
        $this->actingAs($admin);
        Filament::setCurrentPanel(Filament::getPanel('admin'));
        Livewire::test(EditUser::class, ['record' => $user->getKey()])
            ->fillForm(['access_scope' => 'selected', 'content_permissions' => ['notices']])
            ->call('save')
            ->assertHasNoFormErrors();

        $user->refresh();
        $this->assertSame(['notices'], $user->content_permissions);
        $this->assertTrue(Gate::forUser($user)->allows('viewAny', SiteNotice::class));
        $this->assertFalse(Gate::forUser($user)->allows('viewAny', Contact::class));
    }
}
