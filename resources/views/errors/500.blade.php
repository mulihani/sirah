<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ __('app.error_500_title') }} — {{ config('app.name', 'Sirah') }}</title>
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

        {{-- Glowing 500 number --}}
        <div class="relative inline-block mb-8">
            <span class="text-[10rem] font-black leading-none text-transparent bg-clip-text bg-gradient-to-br from-rose-500 to-orange-500 select-none">
                500
            </span>
            <div class="absolute inset-0 blur-3xl bg-rose-500/20 rounded-full -z-10"></div>
        </div>

        {{-- Icon --}}
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-rose-50 dark:bg-rose-900/20 border border-rose-100 dark:border-rose-800 mb-6">
            <svg class="w-8 h-8 text-rose-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
            </svg>
        </div>

        <h1 class="text-3xl md:text-4xl font-bold mb-4 text-gray-900 dark:text-gray-100">
            {{ __('app.error_500_title') }}
        </h1>

        <p class="text-gray-500 dark:text-gray-400 text-lg mb-10 leading-relaxed">
            {{ __('app.error_500_message') }}
        </p>

        {{-- CTA --}}
        <a href="{{ url('/') }}"
           class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-rose-600 hover:bg-rose-700 active:scale-95 text-white font-semibold transition-all duration-200 shadow-lg shadow-rose-500/30">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            {{ __('app.go_home') }}
        </a>

    </div>

</body>
</html>
