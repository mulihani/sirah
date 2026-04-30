<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use App\Services\FallbackService;

class ResumeController extends Controller
{
    public function __construct(protected FallbackService $fallback) {}

    public function __invoke(string $locale)
    {
        $resume = $this->fallback->getContent(
            Resume::query(),
            $locale
        );

        abort_if(! $resume || ! $resume->is_active, 404);

        return view('pages.resume', compact('resume', 'locale'));
    }
}
