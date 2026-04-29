<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SirahInstall extends Command
{
    protected $signature   = 'sirah:install';
    protected $description = 'Install and configure the Sirah system';

    public function handle(): int
    {
        $this->info('');
        $this->info('  ┌─────────────────────────────────────┐');
        $this->info('  │           Sirah Installer           │');
        $this->info('  └─────────────────────────────────────┘');
        $this->info('');

        // 1. Prepare database and Run migrations
        $this->components->task('Running migrations', function () {
            if (config('database.default') === 'sqlite') {
                $dbPath = database_path('database.sqlite');
                if (! file_exists($dbPath)) {
                    touch($dbPath);
                }
            }
            
            Artisan::call('migrate', ['--force' => true]);
            return true;
        });

        // 2. Create storage link
        $this->components->task('Creating storage link', function () {
            if (! file_exists(public_path('storage'))) {
                Artisan::call('storage:link');
            }
            return true;
        });

        // 3. Seed admin user
        $this->components->task('Creating admin user', function () {
            Artisan::call('db:seed', ['--class' => 'AdminSeeder', '--force' => true]);
            return true;
        });

        // 4. Seed defaults settings
        $this->components->task('Seeding default settings', function () {
            Artisan::call('db:seed', ['--class' => 'SettingsSeeder', '--force' => true]);
            return true;
        });

        // 5. Seed sample data
        if ($this->confirm('Seed sample data (works, resume, pages)?', true)) {
            $this->components->task('Seeding sample data', function () {
                Artisan::call('db:seed', ['--class' => 'SampleDataSeeder', '--force' => true]);
                return true;
            });
        }

        // 6. Clear caches
        $this->components->task('Clearing caches', function () {
            Artisan::call('optimize:clear');
            return true;
        });

        $this->info('');
        $this->info('  ✅  Sirah installed successfully!');
        $this->info('');
        $this->table(
            ['Item', 'Value'],
            [
                ['Admin URL',      url('/admin')],
                ['Admin Email',    'admin@sirah.test'],
                ['Admin Password', 'password'],
                ['Frontend URL',   url('/en')],
            ]
        );
        $this->info('');
        $this->warn('  ⚠  Remember to change your admin password!');
        $this->info('');

        return self::SUCCESS;
    }
}
