<?php

namespace App\Http\Controllers;

use App\Modules\OralDefenses\Enums\OralDefenseType;
use App\Modules\OralDefenses\Models\OralDefense;
use App\Modules\Media\Models\MediaAsset;
use App\Modules\Pages\Models\Page;
use App\Modules\SiteSettings\Models\SiteSetting;
use App\Support\Modules;
use Illuminate\Contracts\View\View;

class PageController extends Controller
{
    public function show(string $slug): View
    {
        abort_unless(Modules::enabled('pages'), 404);

        $page = Page::query()
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        abort_if($page->isModule(), 404);

        if ($page->isText()) {
            $view = 'site.page';
        } else {
            $view = view()->exists("site.pages.{$page->template}")
                ? "site.pages.{$page->template}"
                : 'site.page';
        }

        $data = [
            'settings' => SiteSetting::current(),
            'page' => $page,
            'contactUrl' => Modules::enabled('contact_form') ? route('contact') : null,
        ];

        if ($page->template === 'oral-arguments' && Modules::enabled('oral_defenses')) {
            $published = OralDefense::query()
                ->published()
                ->ordered()
                ->with(['videoMedia', 'thumbnailMedia'])
                ->get();

            $data['featuredVideo'] = $published
                ->first(fn (OralDefense $item): bool => $item->type === OralDefenseType::Video && $item->is_featured);
            $data['secondaryVideos'] = $published
                ->filter(fn (OralDefense $item): bool => $item->type === OralDefenseType::Video && ! $item->is_featured)
                ->take(OralDefense::MAX_PUBLISHED_SECONDARY_VIDEOS);
            $data['defenseExamples'] = $published
                ->filter(fn (OralDefense $item): bool => $item->type === OralDefenseType::Defense);
        }

        if ($page->template === 'profile') {
            $data['marcosBioImage'] = MediaAsset::query()
                ->images()
                ->where('original_name', 'marcos-tulio-bio.png')
                ->first();
        }

        return view($view, $data);
    }
}
