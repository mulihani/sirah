<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('admin.maintenance.title') ?? 'Maintenance Mode' }}</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200 antialiased min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full px-6 py-12 bg-white dark:bg-gray-800 shadow-xl rounded-2xl text-center border border-gray-100 dark:border-gray-700">
        <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-blue-50 dark:bg-blue-900/30 text-blue-500 mb-6">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
        </div>
        
        <h1 class="text-2xl md:text-3xl font-bold mb-4">
            {{ \App\Models\Setting::get('owner_name', 'Sirah') }}
        </h1>
        
        <div class="text-gray-600 dark:text-gray-400 text-lg mb-8 leading-relaxed">
            {!! nl2br(e(\App\Models\Setting::get('maintenance_message', __('admin.maintenance.default_message')))) !!}
        </div>
        
        <div class="inline-block px-4 py-2 border border-gray-200 dark:border-gray-700 rounded-full text-sm text-gray-500 dark:text-gray-400">
            {{ __('admin.maintenance.be_back_soon') ?? 'We will be back soon!' }}
        </div>
    </div>
</body>
</html>
