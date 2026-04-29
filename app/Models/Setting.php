<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = [
        'owner_name',
        'contact_email',
        'default_language',
        'site_active',
        'maintenance_message',
        'site_logo',
        'site_favicon',
        'show_site_name',
    ];

    protected $casts = [
        'site_active'     => 'boolean',
        'show_site_name'  => 'boolean',
    ];

    public $timestamps = false;

    /**
     * Get a setting value by key, with a Cache layer.
     * Stores a plain array to avoid Eloquent unserialize issues with the DB cache driver.
     * Cache is invalidated automatically by SettingObserver on update/delete.
     */
    public static function get(string $key, $default = null)
    {
        $settings = Cache::remember('site_settings', now()->addMinutes(60), function () {
            $record = self::first();
            return $record ? $record->toArray() : [];
        });

        return $settings[$key] ?? $default;
    }

    /**
     * Flush the settings cache. Called by SettingObserver.
     */
    public static function flushCache(): void
    {
        Cache::forget('site_settings');
    }
}
