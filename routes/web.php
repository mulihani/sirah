<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SitemapController;
use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;

use App\Http\Middleware\CheckMaintenanceMode;

/*
|--------------------------------------------------------------------------
| Redirect root to default language
|--------------------------------------------------------------------------
*/
Route::middleware([CheckMaintenanceMode::class])->group(function () {
    Route::get('/', function () {
        $langService = app(\App\Services\LanguageService::class);
        return redirect()->to('/' . $langService->getDefaultLanguage());
    });

/*
|--------------------------------------------------------------------------
| Localized routes
|--------------------------------------------------------------------------
*/
Route::middleware([SetLocale::class])
    ->prefix('{locale}')
    ->name('locale.')
    ->group(function () {

        // Home
        Route::get('/', HomeController::class)->name('home');

        // Works
        Route::get('/works', [WorkController::class, 'index'])->name('works.index');
        Route::get('/works/{slug}', [WorkController::class, 'show'])->name('works.show');

        // Resume
        Route::get('/resume', ResumeController::class)->name('resume');

        // Contact
        Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
        Route::post('/contact', [ContactController::class, 'send'])->middleware('throttle:6,1')->name('contact.send');

        // Dynamic pages (must be last)
        Route::get('/{slug}', [PageController::class, 'show'])->name('page.show');
    });

});

/*
|--------------------------------------------------------------------------
| SEO Routes (outside locale middleware)
|--------------------------------------------------------------------------
*/
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/robots.txt', function () {
    return response(view('robots'), 200)->header('Content-Type', 'text/plain');
})->name('robots');
