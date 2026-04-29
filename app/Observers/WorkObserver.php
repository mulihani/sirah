<?php

namespace App\Observers;

use App\Models\Work;
use Illuminate\Support\Facades\Storage;

class WorkObserver
{
    public function updated(Work $work): void
    {
        if ($work->isDirty('cover_image') && ($old = $work->getOriginal('cover_image'))) {
            Storage::disk('public')->delete($old);
        }
    }

    public function deleted(Work $work): void
    {
        if ($work->cover_image) {
            Storage::disk('public')->delete($work->cover_image);
        }
        
        // Also delete related images if cascade delete is not handled by DB
        foreach($work->images as $image) {
            $image->delete();
        }
    }
}
