<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Work;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Generate a dynamic XML sitemap covering all public URLs for both locales.
     */
    public function index(): Response
    {
        $locales = ['en', 'ar'];

        $staticRoutes = [];
        foreach ($locales as $locale) {
            $staticRoutes[] = [
                'url'      => route('locale.home', ['locale' => $locale]),
                'priority' => '1.0',
                'freq'     => 'weekly',
            ];
            $staticRoutes[] = [
                'url'      => route('locale.works.index', ['locale' => $locale]),
                'priority' => '0.9',
                'freq'     => 'weekly',
            ];
            $staticRoutes[] = [
                'url'      => route('locale.resume', ['locale' => $locale]),
                'priority' => '0.8',
                'freq'     => 'monthly',
            ];
            $staticRoutes[] = [
                'url'      => route('locale.contact.show', ['locale' => $locale]),
                'priority' => '0.7',
                'freq'     => 'yearly',
            ];
        }

        // Dynamic works
        $works = Work::whereNotNull('published_at')
            ->select('slug', 'language', 'updated_at')
            ->get();

        $workUrls = $works->map(fn ($w) => [
            'url'      => route('locale.works.show', ['locale' => $w->language, 'slug' => $w->slug]),
            'lastmod'  => optional($w->updated_at)->toAtomString(),
            'priority' => '0.8',
            'freq'     => 'monthly',
        ]);

        // Dynamic pages
        $pages = Page::where('is_published', true)
            ->select('slug', 'language', 'updated_at')
            ->get();

        $pageUrls = $pages->map(fn ($p) => [
            'url'      => route('locale.page.show', ['locale' => $p->language, 'slug' => $p->slug]),
            'lastmod'  => optional($p->updated_at)->toAtomString(),
            'priority' => '0.6',
            'freq'     => 'monthly',
        ]);

        $content = view('sitemap', compact('staticRoutes', 'workUrls', 'pageUrls'))->render();

        return response($content, 200)->header('Content-Type', 'application/xml');
    }
}
