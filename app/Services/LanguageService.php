<?php

namespace App\Services;

use Illuminate\Support\Facades\File;

class LanguageService
{
    /**
     * Scan the /lang directory and return all available locale codes.
     *
     * @return string[]
     */
    public function getAvailableLanguages(): array
    {
        $langPath = base_path('lang');

        if (! File::isDirectory($langPath)) {
            return ['en'];
        }

        $directories = File::directories($langPath);

        $locales = array_map(
            fn ($dir) => basename($dir),
            $directories
        );

        sort($locales);

        return $locales ?: ['en'];
    }

    /**
     * Get the default language from settings (or fallback to 'en').
     */
    public function getDefaultLanguage(): string
    {
        return \App\Models\Setting::get('default_language', config('app.fallback_locale', 'en'));
    }

    /**
     * Check if a given locale is available.
     */
    public function isAvailable(string $locale): bool
    {
        return in_array($locale, $this->getAvailableLanguages(), true);
    }
}
