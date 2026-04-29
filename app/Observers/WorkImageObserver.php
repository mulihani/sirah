<?php

namespace App\Observers;

use App\Models\WorkImage;
use Illuminate\Support\Facades\Storage;

class WorkImageObserver
{
    public function updated(WorkImage $workImage): void
    {
        if ($workImage->isDirty('path') && ($old = $workImage->getOriginal('path'))) {
            Storage::disk('public')->delete($old);
        }
    }

    public function deleted(WorkImage $workImage): void
    {
        if ($workImage->path) {
            Storage::disk('public')->delete($workImage->path);
        }
    }
}
