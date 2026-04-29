<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        Setting::updateOrCreate(['id' => 1], [
            'default_language' => 'en',
            'contact_email' => 'hello@sirah.test',
            'owner_name' => 'Sirah',
            'site_active' => true,
            'maintenance_message' => 'The website is under maintenance. Please check back later.',
            'site_logo' => 'settings/logo.png',
            'site_favicon' => 'settings/favicon.png',
            'show_site_name' => false,
        ]);
    }
}
