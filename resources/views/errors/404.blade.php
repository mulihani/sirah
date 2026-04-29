<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ __('app.error_404_title') }} — {{ config('app.name', 'Sirah') }}</title>
    @vite(['resources/css/app.css'])
    <script>
        (function () {
            const theme = localStorage.getItem('theme') || 'dark';
            document.documentElement.classList.toggle('dark', theme === 'dark');
        })();
    </script>
</head>
<body class="bg-white dark:bg-gray-950 text-gray-900 dark:text-gray-100 font-sans antialiased min-h-screen flex items-center justify-center px-4">

    <div class="max-w-lg w-full text-center">

        {{-- Glowing 404 number --}}
        <div class="relative inline-block mb-8">
            <span class="text-[10rem] font-black leading-none text-transparent bg-clip-text bg-gradient-to-br from-violet-500 to-fuchsia-500 select-none">
                404
            </span>
            <div class="absolute inset-0 blur-3xl bg-violet-500/20 rounded-full -z-10"></div>
        </div>

        {{-- Icon --}}
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-violet-50 dark:bg-violet-900/20 border border-violet-100 dark:border-violet-800 mb-6">
            <svg class="w-8 h-8 text-violet-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
            </svg>
        </div>

        <h1 class="text-3xl md:text-4xl font-bold mb-4 text-gray-900 dark:text-gray-100">
            {{ __('app.error_404_title') }}
        </h1>

        <p class="text-gray-500 dark:text-gray-400 text-lg mb-10 leading-relaxed">
            {{ __('app.error_404_message') }}
        </p>

        {{-- CTA --}}
        <a href="{{ url('/') }}"
           class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-violet-600 hover:bg-violet-700 active:scale-95 text-white font-semibold transition-all duration-200 shadow-lg shadow-violet-500/30">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            {{ __('app.go_home') }}
        </a>

    </div>

</body>
</html>
