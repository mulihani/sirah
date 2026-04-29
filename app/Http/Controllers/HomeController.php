<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Resume;
use App\Models\SocialLink;
use App\Models\Work;
use App\Services\LanguageService;

class HomeController extends Controller
{
    public function __invoke(string $locale)
    {
        // Featured works
        $works = Work::forLanguage($locale)
            ->published()
            ->orderBy('sort_order')
            ->limit(6)
            ->get();

        // Homepage profile (Hero + About)
        $profile = Profile::forLanguage($locale);

        // Skills from Resume — only those flagged for homepage, grouped by category
        $resume   = Resume::forLanguage($locale);
        $skills   = [];
        if ($resume && is_array($resume->skills)) {
            foreach ($resume->skills as $skill) {
                if (!empty($skill['show_on_homepage'])) {
                    $cat = $skill['category'] ?? 'general';
                    $skills[$cat][] = $skill;
                }
            }
        }

        // Social links
        $socialLinks = SocialLink::all();

        return view('pages.home', compact(
            'works',
            'profile',
            'resume',
            'skills',
            'socialLinks',
            'locale'
        ));
    }
}
