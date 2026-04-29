# Sirah – Installation

## Requirements

- PHP 8.3+
- Composer 2.x
- Node.js 20+
- SQLite (default) or MySQL

## Quick Start

```bash
# 1. Clone / copy project
git clone https://github.com/mulihani/sirah.git
cd sirah

# 2. Install PHP dependencies
composer install

# 3. Copy environment file
cp .env.example .env
php artisan key:generate

# 4. Install Node dependencies & build assets
npm install
npm run build

# 5. Run the installer
php artisan sirah:install
```

## Admin Access

The installer creates a default administrator account:

| Field    | Value             |
|----------|-------------------|
| URL      | /admin            |
| Email    | admin@sirah.test  |
| Password | password          |

> ⚠️ **Important:** Change the email and password immediately after your first login via the Admin → Users section or direct DB update.

## Switch to MySQL

In `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sirah
DB_USERNAME=root
DB_PASSWORD=your_password
```

Then run: `php artisan migrate:fresh --seed`

## Add a New Language

1. `mkdir lang/fr`
2. Copy files from `lang/en/` into `lang/fr/`
3. Translate the strings
4. The language appears automatically in the admin settings and frontend switcher

## Mail Configuration

Set `MAIL_MAILER`, `MAIL_HOST`, `MAIL_PORT`, etc. in `.env`.
Update `contact_email` in Admin → Settings.
