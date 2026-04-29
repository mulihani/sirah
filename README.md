<p align="center">
    <img src="public/logo.png" width="200" alt="Sirah Logo" onerror="this.src='https://laravel.com/img/logomark.min.svg'; this.width=100;">
</p>

# Sirah 🚀

**Sirah** is a modern, open-source portfolio and resume management system built with **Laravel 13**, **Filament 5**, **Alpine.js**, and **Tailwind CSS 4**. Designed for developers, designers, and professionals who want a beautiful, multi-language portfolio that is easy to manage.

---

## ✨ Key Features

- 🌍 **Multi-language Support**: Fully translatable into **Arabic** and **English** with native RTL (Right-to-Left) support.
- 🛠️ **Filament Admin Panel**: A powerful and sleek administrative interface to manage your content effortlessly.
- 💼 **Portfolio Management**: Showcase your projects (Works) with a dynamic content builder for flexible layouts.
- 📄 **Resume System**: Structured sections for Education, Experience, Skills, and Certifications.
- 🎨 **Dynamic Branding**: Customize your site name, logo, favicon, and social links directly from the admin panel.
- 📱 **Fully Responsive**: Optimized for all devices, from mobile to desktop.
- 🔍 **SEO Ready**: Dynamic `sitemap.xml`, optimized `robots.txt`, and meta tag support.
- 🔒 **Security**: CSRF protection, XSS-safe templates, rate-limited contact form.

---

## 🚀 Tech Stack

- **Framework**: [Laravel 13](https://laravel.com)
- **Admin Panel**: [Filament 5](https://filamentphp.com)
- **Frontend**: [Alpine.js](https://alpinejs.dev)
- **Styling**: [Tailwind CSS 4](https://tailwindcss.com)
- **Database**: SQLite (Default), MySQL, or PostgreSQL

---

## 🛠️ Installation

### 1. Prerequisites
- PHP 8.3 or higher
- Composer
- Node.js & NPM
- SQLite (or your preferred database)

### 2. Clone the Repository
```bash
git clone https://github.com/sirah/sirah.git
cd sirah
```

### 3. Install Dependencies
```bash
composer install
npm install
```

### 4. Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```
Edit `.env` and configure your database connection, `APP_URL`, and mail settings.

### 5. Run the Sirah Installer
```bash
php artisan sirah:install
```
This command will:
- Run database migrations
- Create the storage symlink (`storage:link`)
- Seed the admin user and default settings
- Optionally seed sample portfolio data

### 6. Build Assets
```bash
npm run build
```

### 7. Run the Application
```bash
php artisan serve
```
Visit `http://localhost:8000` to see your portfolio, and `http://localhost:8000/admin` to access the admin panel.

> ⚠️ **Security**: Change the default admin password immediately after installation.

---

## 📁 Project Structure Highlights

```
app/
├── Console/Commands/SirahInstall.php   # One-command installer
├── Http/Controllers/                   # Frontend controllers
├── Models/                             # Eloquent models with caching
├── Observers/                          # Auto-cleanup on delete/update
├── Providers/ViewServiceProvider.php   # View Composer (no N+1 queries)
├── Services/LanguageService.php        # Language detection & switching
resources/views/
├── layouts/                            # App shell with header/footer partials
├── errors/                             # Custom 404, 500, maintenance pages
├── sitemap.blade.php                   # Dynamic XML sitemap
lang/
├── ar/                                 # Arabic translations (7 files)
└── en/                                 # English translations (7 files)
```

---

## 📸 Screenshots

*(Coming Soon — run `php artisan sirah:install` to see it live)*

---

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request. For major changes, open an issue first.

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

---

## 📄 License

Distributed under the **MIT License**. See `LICENSE` for more information.

---

<p align="center">
    Made with ❤️ for the open-source community.
</p>
