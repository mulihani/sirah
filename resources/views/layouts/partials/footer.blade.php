{{-- $footerPages, $socialLinks, $settings injected by ViewServiceProvider View Composer --}}
<footer class="border-t border-gray-100 dark:border-gray-800 bg-white dark:bg-gray-950 py-10 mt-20">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row items-center justify-between gap-6">

            {{-- Brand --}}
            <p class="text-sm text-gray-500 dark:text-gray-400">
                &copy; {{ date('Y') }} {{ $settings->owner_name ?? 'Sirah' }}
            </p>

            {{-- Footer Pages --}}
            @if ($footerPages->isNotEmpty())
            <div class="flex flex-wrap items-center justify-center gap-x-6 gap-y-2">
                @foreach ($footerPages as $p)
                <a href="{{ route('locale.page.show', ['locale' => app()->getLocale(), 'slug' => $p->slug]) }}"
                   class="text-sm text-gray-600 dark:text-gray-300 hover:text-violet-600 dark:hover:text-violet-400 transition-colors">
                    {{ $p->link_title ?: $p->title }}
                </a>
                @endforeach
            </div>
            @endif

            {{-- Social Links --}}
            {{-- $socialLinks injected by ViewServiceProvider --}}
            @if ($socialLinks->isNotEmpty())
            <div class="flex items-center gap-4">
                @foreach ($socialLinks as $link)
                <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer"
                   class="w-8 h-8 flex items-center justify-center rounded-lg border border-gray-100 dark:border-gray-800 text-gray-400 hover:text-violet-600 dark:hover:text-violet-400 hover:border-violet-200 dark:hover:border-violet-800 transition-all duration-300"
                   title="{{ $link->platform }}">
                    @if ($link->icon)
                        <i class="{{ $link->icon }} text-base"></i>
                    @endif
                </a>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</footer>
