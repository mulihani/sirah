<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\LanguageService;

class AdminLocaleMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $langService = app(LanguageService::class);
        $available = $langService->getAvailableLanguages();
        
        $locale = session()->get('admin_locale');
        
        if (! $locale || ! in_array($locale, $available)) {
            $locale = $langService->getDefaultLanguage();
        }
        
        app()->setLocale($locale);
        
        return $next($request);
    }
}
