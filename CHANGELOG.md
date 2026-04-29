# Changelog

All notable changes to **Sirah** will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

---

## [1.0.0] — 2026-04-29

### Added
- **Multi-language portfolio system** with full Arabic (RTL) and English support
- **Filament 5 Admin Panel** with 6 resources: Profile, Work, Resume, Page, Category, SocialLink, Setting
- **Dynamic Content Builder** for Works — rich text, feature grids, image galleries, and more
- **Portfolio Management**: Works with categories, cover images, slugs, and published date
- **Resume System**: Education, Experience, Skills (with icons), and Certifications
- **Dynamic Branding**: Logo, favicon, site name toggle — all manageable from the admin panel
- **Contact Form** with CSRF protection and rate limiting (6 requests/minute)
- **Custom error pages**: 404, 500, and Maintenance mode — all RTL-aware and dark mode compatible
- **Dynamic `sitemap.xml`** covering all locales, works, and pages
- **Improved `robots.txt`** blocking `/admin` and linking to sitemap
- **View Composer** (`ViewServiceProvider`) — eliminates N+1 queries in header, footer, and layout
- **Settings Cache** — `Setting::get()` now uses `Cache::remember()` with automatic invalidation via Observer
- **Page Observer cache invalidation** — header/footer page caches reset on any Page change
- **`sirah:install` command** — one-command setup covering migrations, storage link, seeders, and cache clear
- **`SampleDataSeeder`** with bilingual sample profile, works, resume, and pages
- **`SettingsSeeder`** using `updateOrCreate()` for idempotent seeding
- **7 translation files** per locale (`app`, `contact`, `navigation`, `resume`, `works`, `meta`, `admin`)
- **Security**: XSS-safe maintenance message via `nl2br(e(...))`, `APP_DEBUG=false` for production

### Security
- Fixed XSS vulnerability in `maintenance.blade.php` (was using `{!! !!}` without escaping)
- Added `throttle:6,1` middleware to `POST /contact`
- Added `database/database.sqlite` to `.gitignore` to prevent leaking development data
- Production `.env` defaults: `APP_DEBUG=false`, `APP_ENV=production`, `LOG_LEVEL=warning`

---

## [Unreleased]

### Planned
- Screenshot gallery in README
- Automated tests (Feature & Unit)
- Additional error pages (403, 419, 429)
- `CHANGELOG.md` auto-generation via CI
