<?php

namespace App\Http\Controllers;

use App\Models\Work;
use App\Services\FallbackService;

class WorkController extends Controller
{
    public function __construct(protected FallbackService $fallback) {}

    public function index(string $locale)
    {
        $works = Work::forLanguage($locale)
            ->published()
            ->with('category')
            ->orderBy('sort_order')
            ->get();

        return view('pages.works.index', compact('works', 'locale'));
    }

    public function show(string $locale, string $slug)
    {
        $work = $this->fallback->getContent(
            Work::query()->where('slug', $slug)->with(['images', 'category']),
            $locale
        );

        if (! $work) {
            abort(404);
        }

        return view('pages.works.show', compact('work', 'locale'));
    }
}
