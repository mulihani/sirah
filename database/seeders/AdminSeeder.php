<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\SocialLink;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@sirah.test'],
            [
                'name'     => 'Admin',
                'email'    => 'admin@sirah.test',
                'password' => Hash::make('password'),
            ]
        );
    }
}
