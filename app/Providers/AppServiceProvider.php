<?php

namespace App\Providers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(ViewServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \App\Models\Profile::observe(\App\Observers\ProfileObserver::class);
        \App\Models\Work::observe(\App\Observers\WorkObserver::class);
        \App\Models\WorkImage::observe(\App\Observers\WorkImageObserver::class);
        \App\Models\Resume::observe(\App\Observers\ResumeObserver::class);
        \App\Models\Setting::observe(\App\Observers\SettingObserver::class);

        // Flush header/footer page caches whenever a Page is saved or deleted
        $flushPageCache = function () {
            foreach (['ar', 'en'] as $locale) {
                Cache::forget("header_pages_{$locale}");
                Cache::forget("footer_pages_{$locale}");
            }
        };

        \App\Models\Page::created($flushPageCache);
        \App\Models\Page::updated($flushPageCache);
        \App\Models\Page::deleted($flushPageCache);
    }
}
