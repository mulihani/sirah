# Sirah – Architecture

## Overview

Sirah is a single-owner personal portfolio platform built with:

- **Laravel 13** – Backend framework
- **Filament v5** – Admin panel (TALL Stack)
- **Blade + Tailwind CSS v4** – Frontend
- **SQLite** (default) or **MySQL** – Database

## Directory Structure

```
app/
  Console/Commands/SirahInstall.php   ← php artisan sirah:install
  Filament/
    Resources/
      CategoryResource.php
      PageResource.php
      ProfileResource.php             ← Profile & Hero branding
      ResumeResource.php
      SocialLinkResource.php
      WorkResource.php
      Settings/                       ← Record-based settings system
        SettingResource.php           ← Single-record management
  Http/
    Controllers/                      ← Thin controllers
    Middleware/SetLocale.php          ← Sets app locale from {locale} param
    Requests/StoreContactRequest.php  ← Form validation
  Mail/ContactMail.php                ← Contact form mailable
  Models/                             ← Profile, Work, Resume, Page, Category...
  Providers/Filament/AdminPanelProvider.php
  Services/
    LanguageService.php               ← Scans /lang folders
    FallbackService.php               ← Content fallback logic
    ContactMailService.php            ← Messaging logic
database/
  migrations/                         ← Schema versioning
  seeders/                            ← Default & Sample data
lang/
  ar/ en/                             ← Translation dictionaries
resources/views/
  layouts/                            ← Core layouts & components
  pages/                              ← Blade templates for views
  emails/                             ← Mailable views
routes/web.php                        ← {locale} prefixed routes
docs/                                 ← System documentation
```

## Request Lifecycle

```
Browser → /{locale}/... → SetLocale Middleware → Controller → Service → Model → View
```

## Admin Panel

URL: `/admin`
Powered by Filament v5. Resources are located in `app/Filament/Resources/`.
The settings system is customized to manage a single global record instead of multiple rows.
