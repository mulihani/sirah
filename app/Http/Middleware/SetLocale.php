<?php

namespace App\Http\Middleware;

use App\Services\LanguageService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function __construct(protected LanguageService $languageService) {}

    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->route('locale');

        // Validate that locale exists in /lang folders
        if ($locale && $this->languageService->isAvailable($locale)) {
            app()->setLocale($locale);
        } else {
            // Fall back to default language
            app()->setLocale($this->languageService->getDefaultLanguage());
        }

        return $next($request);
    }
}
