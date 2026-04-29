<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkImage extends Model
{
    protected $fillable = ['work_id', 'path', 'caption', 'sort_order'];

    public function work(): BelongsTo
    {
        return $this->belongsTo(Work::class);
    }
}
