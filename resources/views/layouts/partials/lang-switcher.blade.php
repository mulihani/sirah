@php
    $langService = app(\App\Services\LanguageService::class);
    $languages   = $langService->getAvailableLanguages();
    $current     = app()->getLocale();
@endphp

@if (count($languages) > 1)
<div class="relative" x-data="{ open: false }" @keydown.escape.window="open = false" @click.away="open = false">
    {{-- Trigger Button --}}
    <button @click="open = !open"
            class="flex items-center gap-2 px-3 py-1.5 text-sm font-bold rounded-lg border border-gray-200 dark:border-gray-700 bg-transparent hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors uppercase text-gray-700 dark:text-gray-200">
        {{ strtoupper($current) }}
        <svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" />
        </svg>
    </button>

    {{-- Dropdown Menu --}}
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="absolute end-0 mt-2 w-56 rounded-xl bg-white dark:bg-[#18181b] shadow-2xl border border-gray-200 dark:border-gray-800 overflow-hidden z-50 divide-y divide-gray-100 dark:divide-gray-800"
         style="display: none;">
         
        {{-- Header --}}
        <div class="px-4 py-3 flex items-center justify-between bg-gray-50/50 dark:bg-[#18181b]">
            <span class="text-sm font-medium text-gray-900 dark:text-gray-300">
                اللغة الحالية: {{ __('meta.name') }}
            </span>
            <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" />
            </svg>
        </div>

        {{-- Languages List --}}
        <div class="p-1">
            @foreach ($languages as $lang)
                @php
                    $isActive = $lang === $current;
                    $langName = __('meta.name', [], $lang);
                @endphp
                
                @if($isActive)
                    <div class="flex items-center justify-between px-3 py-2 rounded-lg bg-gray-50 dark:bg-gray-800/50 cursor-default">
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $langName }}</span>
                        <svg class="w-4 h-4 text-gray-900 dark:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                @else
                    <a href="/{{ $lang }}" class="flex items-center justify-between px-3 py-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors group">
                        <span class="text-sm font-medium text-gray-600 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white transition-colors">
                            {{ $langName }}
                        </span>
                        <span class="text-sm text-gray-400 dark:text-gray-500 font-medium uppercase">{{ $lang }}</span>
                    </a>
                @endif
            @endforeach
        </div>
    </div>
</div>
@endif
