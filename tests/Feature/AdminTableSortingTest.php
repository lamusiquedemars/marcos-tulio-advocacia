<?php

namespace Tests\Feature;

use App\Filament\Resources\Galleries\Pages\EditGallery;
use App\Filament\Resources\Galleries\RelationManagers\ImagesRelationManager;
use App\Models\User;
use App\Modules\Acquisition\Filament\Widgets\AcquisitionCampaignPerformance;
use App\Modules\Acquisition\Models\AcquisitionReportingSnapshot;
use App\Modules\Contacts\Filament\Resources\Contacts\ContactResource;
use App\Modules\Contacts\Models\Contact;
use App\Modules\Conversations\Actions\StartAnonymousConversation;
use App\Modules\Conversations\Filament\Resources\Conversations\Pages\ListConversations;
use App\Modules\Gallery\Models\Gallery;
use App\Modules\Inquiries\Enums\InquiryStatus;
use App\Modules\Inquiries\Filament\Resources\Inquiries\Pages\ManageInquiries;
use App\Modules\Inquiries\Models\Inquiry;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AdminTableSortingTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create(['is_admin' => true]));
        Filament::setCurrentPanel(Filament::getPanel('admin'));
    }

    public function test_every_resource_sortable_column_executes_in_both_directions(): void
    {
        foreach (Filament::getResources() as $resource) {
            $page = $resource::getPages()['index']->getPage();
            $component = Livewire::test($page)->assertSuccessful();
            foreach ($component->instance()->getTable()->getColumns() as $column) {
                if (! $column->isSortable() || $column->isToggledHidden()) {
                    continue;
                }
                $component->call('sortTable', $column->getName())
                    ->assertSet('tableSort', $column->getName().':asc')
                    ->assertSuccessful()
                    ->call('sortTable', $column->getName())
                    ->assertSet('tableSort', $column->getName().':desc')
                    ->assertSuccessful();
            }
        }
    }

    public function test_inquiry_priority_is_default_and_explicit_sort_preserves_search_and_filters(): void
    {
        $z = Inquiry::create(['name' => 'Zulu', 'email' => 'z@example.test', 'message' => 'Test', 'status' => InquiryStatus::New]);
        $a = Inquiry::create(['name' => 'Alpha', 'email' => 'a@example.test', 'message' => 'Test', 'status' => InquiryStatus::ToHandle]);
        $component = Livewire::test(ManageInquiries::class)
            ->assertCanSeeTableRecords([$z, $a], inOrder: true)
            ->call('sortTable', 'name')
            ->assertCanSeeTableRecords([$a, $z], inOrder: true)
            ->call('sortTable', 'name')
            ->assertCanSeeTableRecords([$z, $a], inOrder: true)
            ->searchTable('Alpha')
            ->assertCanSeeTableRecords([$a])
            ->assertCanNotSeeTableRecords([$z]);
        $component->call('sortTable', 'email')->assertSet('tableSearch', 'Alpha');
        $component->searchTable('')->filterTable('status', InquiryStatus::New->value)
            ->call('sortTable', 'name')
            ->assertCanSeeTableRecords([$z])->assertCanNotSeeTableRecords([$a]);
    }

    public function test_conversation_relationship_sort_overrides_recency(): void
    {
        $z = StartAnonymousConversation::run()->conversation;
        $a = StartAnonymousConversation::run()->conversation;
        foreach ([[$z, 'Zulu', now()], [$a, 'Alpha', now()->subDay()]] as [$record, $name, $date]) {
            $record->update(['contact_id' => Contact::create(['display_name' => $name])->id, 'last_message_at' => $date]);
        }
        Livewire::test(ListConversations::class)
            ->assertCanSeeTableRecords([$z, $a], inOrder: true)
            ->call('sortTable', 'contact.display_name')
            ->assertCanSeeTableRecords([$a, $z], inOrder: true)
            ->call('sortTable', 'contact.display_name')
            ->assertCanSeeTableRecords([$z, $a], inOrder: true)
            ->assertTableColumnExists('messages.content', fn ($column) => ! $column->isSortable());
    }

    public function test_sorting_restarts_pagination_and_orders_the_whole_result_set(): void
    {
        foreach (range(1, 30) as $index) {
            Contact::create(['display_name' => sprintf('Contact %02d', $index)]);
        }
        $resource = ContactResource::class;
        $component = Livewire::test($resource::getPages()['index']->getPage())
            ->set('tableRecordsPerPage', 10)
            ->call('gotoPage', 2)
            ->call('sortTable', 'display_name')
            ->assertSet('paginators.page', 1);
        $this->assertSame('Contact 01', $component->instance()->getTableRecords()->first()->display_name);
        $component->call('sortTable', 'display_name');
        $this->assertSame('Contact 30', $component->instance()->getTableRecords()->first()->display_name);
    }

    public function test_campaign_report_renders_and_sorts_without_reordering_its_summary_columns(): void
    {
        AcquisitionReportingSnapshot::create([
            'site_reference' => config('maracuja.acquisition.cremona.site_reference'),
            'fetched_at' => now(),
            'payload' => ['campaigns' => [
                ['name' => 'Zulu campaign', 'channel' => 'meta_ads', 'spend' => 100],
                ['name' => 'Alpha campaign', 'channel' => 'google_ads', 'spend' => 20],
            ]],
        ]);
        Livewire::test(AcquisitionCampaignPerformance::class)
            ->assertSeeInOrder(['Zulu campaign', 'Alpha campaign'])
            ->call('sortReport', 'name')->assertSeeInOrder(['Alpha campaign', 'Zulu campaign'])
            ->call('sortReport', 'name')->assertSeeInOrder(['Zulu campaign', 'Alpha campaign']);
    }

    public function test_relation_table_preserves_position_default_and_sorts_titles(): void
    {
        $gallery = Gallery::create(['title' => 'Test', 'slug' => 'test']);
        $z = $gallery->images()->create(['title' => 'Zulu', 'image_path' => 'z.jpg', 'position' => 1]);
        $a = $gallery->images()->create(['title' => 'Alpha', 'image_path' => 'a.jpg', 'position' => 2]);
        Livewire::test(ImagesRelationManager::class, ['ownerRecord' => $gallery, 'pageClass' => EditGallery::class])
            ->assertCanSeeTableRecords([$z, $a], inOrder: true)
            ->call('sortTable', 'title')
            ->assertCanSeeTableRecords([$a, $z], inOrder: true)
            ->call('sortTable', 'title')
            ->assertCanSeeTableRecords([$z, $a], inOrder: true)
            ->assertTableColumnExists('resolved_image_url', fn ($column) => ! $column->isSortable());
    }
}
