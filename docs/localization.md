# Sirah – Localization System

## How It Works

Languages are defined by **folder existence** in `/lang`:

```
lang/
  ar/       ← Arabic
  en/       ← English
  fr/       ← French (add to enable)
```

No configuration file needed. `LanguageService::getAvailableLanguages()` scans the `/lang` directory at runtime.

## Routes

All frontend routes use the `/{locale}` prefix:

```
/en/works
/ar/resume
/en/contact
```

The root `/` automatically redirects to the default language set in Settings.

## Middleware & Detection

- **SetLocale Middleware**: Reads `{locale}` from the route, validates it, and sets `app()->setLocale()`.
- **LanguageService**: Provides available languages and system-wide locale logic.

## Translation Files

Use `__('file.key')` in Blade views for static strings:

```php
__('navigation.home')     // lang/en/navigation.php → 'home'
__('app.site_name')       // lang/ar/app.php → 'Sirah'
```

## Content Translation

Most content modules in Sirah are language-specific:
- **Works, Pages, Categories**: Have a `language` column and a unique slug per language.
- **Resumes & Profiles**: Have a **UNIQUE** language column (only one record per language).
- **Fallback**: Powered by `FallbackService::getContent()`. If a record doesn't exist in the current locale, it attempts to load the record from the `default_language` setting.

## Adding a New Language

```bash
cp -r lang/en lang/fr
# Translate the strings in lang/fr/*.php
```

The new language `fr` will immediately appear in:
- Admin → Settings → Default Language dropdown
- Frontend language switcher
- Language selection in all multi-language resources (Works, Profiles, etc.)
