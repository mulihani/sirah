<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class FallbackService
{
    public function __construct(
        protected LanguageService $languageService
    ) {}

    /**
     * Try to find content in the current locale,
     * then fall back to the default language,
     * then return null.
     *
     * @param  Builder  $query  A query scoped to the model (without language filter)
     * @param  string  $locale  Current locale
     * @return Model|null
     */
    public function getContent(Builder $query, string $locale): ?Model
    {
        // 1. Try current locale
        $record = (clone $query)->where('language', $locale)->first();

        if ($record !== null) {
            return $record;
        }

        // 2. Try default language
        $default = $this->languageService->getDefaultLanguage();

        if ($default !== $locale) {
            $record = (clone $query)->where('language', $default)->first();
        }

        // 3. Return null (empty state)
        return $record;
    }
}
