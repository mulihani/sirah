{{-- $headerPages injected by ViewServiceProvider View Composer --}}
<header class="sticky top-0 z-50 w-full border-b border-gray-100 dark:border-gray-800 bg-white/80 dark:bg-gray-950/80 backdrop-blur-md">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">

        {{-- Logo / Brand --}}
        <a href="{{ route('locale.home', ['locale' => app()->getLocale()]) }}"
           class="flex items-center gap-2.5 hover:opacity-80 transition-opacity">
            @if($settings && $settings->site_logo)
                <img src="{{ Storage::disk('public')->url($settings->site_logo) }}" 
                     alt="{{ $settings->owner_name }}" 
                     class="h-8 w-auto object-contain">
            @endif
            
            @if($settings && $settings->show_site_name)
                <span class="text-xl font-bold text-violet-600 dark:text-violet-400 tracking-tight">
                    {{ $settings->owner_name ?? 'Sirah' }}
                </span>
            @endif
        </a>

        {{-- Nav Links --}}
        <nav class="hidden md:flex items-center gap-6 text-sm font-medium">
            <a href="{{ route('locale.home', ['locale' => app()->getLocale()]) }}"
               class="text-gray-600 dark:text-gray-300 hover:text-violet-600 dark:hover:text-violet-400 transition-colors">
                {{ __('navigation.home') }}
            </a>
            <a href="{{ route('locale.works.index', ['locale' => app()->getLocale()]) }}"
               class="text-gray-600 dark:text-gray-300 hover:text-violet-600 dark:hover:text-violet-400 transition-colors">
                {{ __('navigation.works') }}
            </a>
            @if($isResumeActive ?? false)
            <a href="{{ route('locale.resume', ['locale' => app()->getLocale()]) }}"
               class="text-gray-600 dark:text-gray-300 hover:text-violet-600 dark:hover:text-violet-400 transition-colors">
                {{ __('navigation.resume') }}
            </a>
            @endif
            <a href="{{ route('locale.contact.show', ['locale' => app()->getLocale()]) }}"
               class="text-gray-600 dark:text-gray-300 hover:text-violet-600 dark:hover:text-violet-400 transition-colors">
                {{ __('navigation.contact') }}
            </a>

            @if ($headerPages->isNotEmpty())
            <div class="relative" x-data="{ open: false }" @keydown.escape.window="open = false" @click.away="open = false">
                <button @click="open = !open" class="flex items-center gap-1 text-gray-600 dark:text-gray-300 hover:text-violet-600 dark:hover:text-violet-400 transition-colors">
                    {{ __('admin.resources.pages') }}
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="open" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="absolute end-0 mt-2 w-48 rounded-xl bg-white dark:bg-[#18181b] shadow-2xl border border-gray-200 dark:border-gray-800 overflow-hidden z-50 divide-y divide-gray-100 dark:divide-gray-800"
                     style="display: none;">
                    <div class="p-1">
                        @foreach ($headerPages as $p)
                        <a href="{{ route('locale.page.show', ['locale' => app()->getLocale(), 'slug' => $p->slug]) }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800/50 hover:text-violet-600 dark:hover:text-violet-400 transition-colors rounded-lg">
                            {{ $p->link_title ?: $p->title }}
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </nav>

        {{-- Right Controls --}}
        <div class="flex items-center gap-3">

            {{-- Language Switcher --}}
            @include('layouts.partials.lang-switcher')

            {{-- Dark Mode Toggle --}}
            <button id="theme-toggle" aria-label="{{ __('app.theme_toggle') }}"
                    class="w-9 h-9 flex items-center justify-center rounded-lg border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                {{-- Sun icon (shown in dark mode) --}}
                <svg class="hidden dark:block w-4 h-4 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m8.66-9h-1M4.34 12h-1m15.07-6.36-.7.7M5.64 18.36l-.7.7m12.73 0-.7-.7M5.64 5.64l-.7-.7M12 7a5 5 0 110 10A5 5 0 0112 7z"/>
                </svg>
                {{-- Moon icon (shown in light mode) --}}
                <svg class="block dark:hidden w-4 h-4 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/>
                </svg>
            </button>

            {{-- Mobile Menu Button --}}
            <button id="mobile-menu-btn" class="md:hidden w-9 h-9 flex items-center justify-center rounded-lg border border-gray-200 dark:border-gray-700">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- Mobile Nav --}}
    <div id="mobile-menu" class="md:hidden hidden border-t border-gray-100 dark:border-gray-800 bg-white dark:bg-gray-950 px-4 py-4 space-y-2">
        <a href="{{ route('locale.home', ['locale' => app()->getLocale()]) }}" class="block py-2 text-gray-700 dark:text-gray-300">{{ __('navigation.home') }}</a>
        <a href="{{ route('locale.works.index', ['locale' => app()->getLocale()]) }}" class="block py-2 text-gray-700 dark:text-gray-300">{{ __('navigation.works') }}</a>
        @if($isResumeActive ?? false)
        <a href="{{ route('locale.resume', ['locale' => app()->getLocale()]) }}" class="block py-2 text-gray-700 dark:text-gray-300">{{ __('navigation.resume') }}</a>
        @endif
        <a href="{{ route('locale.contact.show', ['locale' => app()->getLocale()]) }}" class="block py-2 text-gray-700 dark:text-gray-300">{{ __('navigation.contact') }}</a>
        
        @if ($headerPages->isNotEmpty())
        <div class="border-t border-gray-100 dark:border-gray-800 my-2 pt-2">
            <span class="block px-2 text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">{{ __('admin.resources.pages') }}</span>
            @foreach ($headerPages as $p)
            <a href="{{ route('locale.page.show', ['locale' => app()->getLocale(), 'slug' => $p->slug]) }}" class="block py-2 pl-4 text-gray-700 dark:text-gray-300">{{ $p->link_title ?: $p->title }}</a>
            @endforeach
        </div>
        @endif
    </div>
</header>

<script>
    // Dark mode toggle
    document.getElementById('theme-toggle').addEventListener('click', function () {
        const isDark = document.documentElement.classList.toggle('dark');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
    });

    // Mobile menu
    document.getElementById('mobile-menu-btn').addEventListener('click', function () {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });
</script>
