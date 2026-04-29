<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Page extends Model
{
    protected $fillable = [
        'title',
        'link_title',
        'slug',
        'content',
        'language',
        'category_id',
        'is_published',
        'display_position',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeForLanguage($query, string $language)
    {
        return $query->where('language', $language);
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }
}
