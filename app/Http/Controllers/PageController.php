<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Services\FallbackService;

class PageController extends Controller
{
    public function __construct(protected FallbackService $fallback) {}

    public function show(string $locale, string $slug)
    {
        $page = $this->fallback->getContent(
            Page::query()->where('slug', $slug)->published(),
            $locale
        );

        if (! $page) {
            abort(404);
        }

        return view('pages.page', compact('page', 'locale'));
    }
}
