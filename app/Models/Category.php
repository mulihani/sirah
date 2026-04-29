<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = ['type', 'name', 'slug', 'language', 'options'];

    protected $casts = [
        'options' => 'array',
    ];

    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type);
    }
    public function works(): HasMany
    {
        return $this->hasMany(Work::class);
    }

    public function pages(): HasMany
    {
        return $this->hasMany(Page::class);
    }

    public function scopeForLanguage($query, string $language)
    {
        return $query->where('language', $language);
    }
}
