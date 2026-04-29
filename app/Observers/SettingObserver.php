<?php

namespace App\Observers;

use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class SettingObserver
{
    public function updated(Setting $setting): void
    {
        // Invalidate the settings cache so the next request fetches fresh data
        Setting::flushCache();

        if ($setting->isDirty('site_logo') && ($old = $setting->getOriginal('site_logo'))) {
            Storage::disk('public')->delete($old);
        }

        if ($setting->isDirty('site_favicon') && ($old = $setting->getOriginal('site_favicon'))) {
            Storage::disk('public')->delete($old);
        }
    }

    public function deleted(Setting $setting): void
    {
        // Invalidate the settings cache
        Setting::flushCache();

        // Settings are rarely deleted, but for completeness:
        if ($setting->site_logo) {
            Storage::disk('public')->delete($setting->site_logo);
        }

        if ($setting->site_favicon) {
            Storage::disk('public')->delete($setting->site_favicon);
        }
    }
}
