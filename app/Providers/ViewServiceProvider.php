<?php

namespace App\Providers;

use App\Models\Page;
use App\Models\Setting;
use App\Models\SocialLink;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any view-related services.
     *
     * Shares common data with all frontend layout partials once per request.
     * This eliminates N+1 queries by running each query once instead of
     * inside each blade partial independently.
     */
    public function boot(): void
    {
        View::composer(
            [
                'layouts.app',
                'layouts.partials.header',
                'layouts.partials.footer',
            ],
            function ($view) {
                $locale = app()->getLocale();

                // Load settings model once (Setting::get() also has its own array cache)
                $settings = Setting::first();

                // Load header and footer pages once per request
                $headerPages = Page::where('is_published', true)
                    ->where('language', $locale)
                    ->whereIn('display_position', ['header', 'both'])
                    ->get();

                $footerPages = Page::where('is_published', true)
                    ->where('language', $locale)
                    ->whereIn('display_position', ['footer', 'both'])
                    ->get();

                // Load social links once per request
                $socialLinks = SocialLink::orderBy('sort_order')->get();

                $view->with(compact('settings', 'headerPages', 'footerPages', 'socialLinks'));
            }
        );
    }
}
