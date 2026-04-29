<?php

namespace App\Observers;

use App\Models\Profile;
use Illuminate\Support\Facades\Storage;

class ProfileObserver
{
    public function updated(Profile $profile): void
    {
        if ($profile->isDirty('profile_photo') && ($old = $profile->getOriginal('profile_photo'))) {
            Storage::disk('public')->delete($old);
        }

        if ($profile->isDirty('about_photo') && ($old = $profile->getOriginal('about_photo'))) {
            Storage::disk('public')->delete($old);
        }
    }

    public function deleted(Profile $profile): void
    {
        if ($profile->profile_photo) {
            Storage::disk('public')->delete($profile->profile_photo);
        }

        if ($profile->about_photo) {
            Storage::disk('public')->delete($profile->about_photo);
        }
    }
}
