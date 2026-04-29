<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ __('meta.dir') }}" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="@yield('meta_description', __('app.tagline'))" />
    <title>@yield('title', __('app.site_name')) | {{ $settings->owner_name ?? 'Sirah' }}</title>

    {{-- Google Fonts: Inter & Tajawal --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Tajawal:wght@400;500;700;800;900&display=swap"
        rel="stylesheet">

    <link rel="icon" type="image/x-icon"
        href="{{ ($settings && $settings->site_favicon) ? Storage::disk('public')->url($settings->site_favicon) : asset('favicon.ico') }}">

    {{-- Icon Libraries: Devicon & FontAwesome --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Dark mode: read from localStorage before paint --}}
    <script>
        (function () {
            const theme = localStorage.getItem('theme') || 'dark';
            document.documentElement.classList.toggle('dark', theme === 'dark');
        })();
    </script>
</head>

<body
    class="bg-white dark:bg-gray-950 text-gray-900 dark:text-gray-100 font-sans antialiased transition-colors duration-300 min-h-screen flex flex-col">

    {{-- ════════════ HEADER ════════════ --}}
    @include('layouts.partials.header')

    {{-- ════════════ MAIN ════════════ --}}
    <main class="flex-1">
        @yield('content')
    </main>

    {{-- ════════════ FOOTER ════════════ --}}
    @include('layouts.partials.footer')

</body>

</html>