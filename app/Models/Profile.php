<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'language',
        'title',
        'hero_title',
        'hero_subtitle',
        'about_me',
        'about_title',
        'profile_photo',
        'about_photo',
        'stats',
    ];

    protected $casts = [
        'stats' => 'array',
    ];

    /**
     * Get the profile for the given language. Returns null if not found.
     */
    public static function forLanguage(string $language): ?static
    {
        return static::where('language', $language)->first();
    }
}
