<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    protected $fillable = [
        'language',
        'is_active',
        'summary',
        'experience',
        'education',
        'skills',
        'certifications',
        'pdf_path',
    ];

    protected $casts = [
        'is_active'      => 'boolean',
        'experience'     => 'array',
        'education'      => 'array',
        'skills'         => 'array',
        'certifications' => 'array',
    ];

    /**
     * Get or create a resume for the given language.
     */
    public static function forLanguage(string $language): ?static
    {
        return static::where('language', $language)->first();
    }
}
