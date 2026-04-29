<?php

namespace App\Observers;

use App\Models\Resume;
use Illuminate\Support\Facades\Storage;

class ResumeObserver
{
    public function updated(Resume $resume): void
    {
        if ($resume->isDirty('pdf_path') && ($old = $resume->getOriginal('pdf_path'))) {
            Storage::disk('public')->delete($old);
        }
    }

    public function deleted(Resume $resume): void
    {
        if ($resume->pdf_path) {
            Storage::disk('public')->delete($resume->pdf_path);
        }
    }
}
