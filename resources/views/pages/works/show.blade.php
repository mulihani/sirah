@extends('layouts.app')

@section('title', $work->title)

@section('content')
<article class="relative min-h-screen overflow-hidden pb-20 pt-24">
    {{-- Decorative ambient background --}}
    <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-violet-400/10 dark:bg-violet-900/20 rounded-full blur-[120px] translate-x-1/3 -translate-y-1/3 pointer-events-none"></div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

    {{-- Back --}}
    <a href="{{ route('locale.works.index', ['locale' => $locale]) }}"
       class="inline-flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 hover:text-violet-600 dark:hover:text-violet-400 transition-colors mb-8">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="{{ app()->getLocale() === 'ar' ? 'M9 5l7 7-7 7' : 'M15 19l-7-7 7-7' }}"/>
        </svg>
        {{ __('app.back') }}
    </a>

    {{-- Meta --}}
    @if ($work->category)
    <span class="inline-block px-4 py-1.5 rounded-full text-xs font-bold bg-violet-100 dark:bg-violet-900/50 text-violet-600 dark:text-violet-400 uppercase tracking-widest shadow-sm animate-pulse mb-4">{{ $work->category->name }}</span>
    @endif

    <h1 class="text-4xl sm:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-gray-900 to-gray-500 dark:from-white dark:to-gray-400 mt-2 mb-10">{{ $work->title }}</h1>

    {{-- Cover Image --}}
    @if ($work->cover_image)
    <div class="relative group mb-16 animate-float">
        {{-- Hover Glow --}}
        <div class="absolute inset-0 bg-violet-400/30 dark:bg-violet-600/30 blur-2xl rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-700 pointer-events-none scale-105"></div>
        <div class="rounded-3xl overflow-hidden aspect-video border-[6px] border-white dark:border-gray-800 shadow-2xl relative z-10">
            <img src="{{ Storage::url($work->cover_image) }}" alt="{{ $work->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
        </div>
    </div>
    @endif

    {{-- Description / Builder Blocks --}}
    @if ($work->description)
        @if (is_array($work->description))
            <div class="space-y-16 mb-16">
            @foreach ($work->description as $block)
                {{-- Rich Text Block --}}
                @if ($block['type'] === 'rich_text')
                    <div class="prose prose-lg prose-gray dark:prose-invert max-w-none">
                        {!! $block['data']['content'] ?? '' !!}
                    </div>
                
                {{-- Feature Grid Block --}}
                @elseif ($block['type'] === 'feature_grid')
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach ($block['data']['features'] ?? [] as $feature)
                        <div class="p-6 bg-white dark:bg-gray-800 rounded-3xl shadow-xl shadow-gray-200/20 dark:shadow-black/20 border border-gray-100 dark:border-gray-700 hover:-translate-y-1 transition-all">
                            @if(!empty($feature['icon']))
                            <div class="w-12 h-12 flex items-center justify-center bg-violet-100 dark:bg-gray-900 rounded-2xl mb-4 text-violet-600 dark:text-violet-400 border border-violet-200 dark:border-gray-700">
                                <i class="{{ $feature['icon'] }} text-2xl"></i>
                            </div>
                            @endif
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ $feature['title'] ?? '' }}</h3>
                            <p class="text-gray-600 dark:text-gray-400">{{ $feature['text'] ?? '' }}</p>
                        </div>
                        @endforeach
                    </div>
                
                {{-- Challenge & Solution Block --}}
                @elseif ($block['type'] === 'challenge_solution')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 relative">
                        <div class="p-8 rounded-[2rem] bg-rose-50 dark:bg-rose-900/10 border border-rose-100 dark:border-rose-900/30 relative z-10">
                            <h3 class="text-xs font-bold text-rose-600 dark:text-rose-400 uppercase tracking-widest mb-4 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                {{ __('admin.fields.the_challenge') }}
                            </h3>
                            <div class="prose prose-rose dark:prose-invert max-w-none">
                                {!! $block['data']['challenge'] ?? '' !!}
                            </div>
                        </div>
                        <div class="p-8 rounded-[2rem] bg-emerald-50 dark:bg-emerald-900/10 border border-emerald-100 dark:border-emerald-900/30 relative z-10">
                            <h3 class="text-xs font-bold text-emerald-600 dark:text-emerald-400 uppercase tracking-widest mb-4 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ __('admin.fields.the_solution') }}
                            </h3>
                            <div class="prose prose-emerald dark:prose-invert max-w-none">
                                {!! $block['data']['solution'] ?? '' !!}
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
            </div>
        @else
            {{-- Legacy string fallback --}}
            <div class="prose prose-lg prose-gray dark:prose-invert max-w-none mb-16">
                {!! $work->description !!}
            </div>
        @endif
    @endif

    {{-- Video --}}
    @if ($work->video_url)
    <div class="mb-12">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">{{ __('works.video') }}</h2>
        <div class="rounded-2xl overflow-hidden aspect-video bg-gray-100 dark:bg-gray-800">
            <iframe src="{{ $work->video_url }}" class="w-full h-full" allowfullscreen></iframe>
        </div>
    </div>
    @endif

    {{-- Links --}}
    @if ($work->links && count($work->links) > 0)
    <div class="mb-16">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-3">
            {{ __('works.links') }}
            <div class="h-px flex-1 bg-gradient-to-r from-gray-200 to-transparent dark:from-gray-800"></div>
        </h2>
        <div class="flex flex-wrap gap-4">
            @foreach ($work->links as $link)
            <a href="{{ $link['url'] }}" target="_blank" rel="noopener noreferrer"
               class="group relative inline-flex items-center gap-3 px-6 py-3 rounded-full bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 text-sm font-bold text-gray-700 dark:text-gray-300 hover:border-violet-400 hover:text-violet-600 dark:hover:text-violet-400 transition-all hover:shadow-lg hover:shadow-violet-500/10 hover:-translate-y-1">
                {{ $link['label'] }}
                <div class="bg-gray-50 dark:bg-gray-900 rounded-full p-1.5 group-hover:bg-violet-50 dark:group-hover:bg-violet-900 transition-colors">
                    <svg class="w-3.5 h-3.5 transform group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Gallery --}}
    @if ($work->images->isNotEmpty())
    <div>
        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-3">
            {{ __('works.gallery') }}
            <div class="h-px flex-1 bg-gradient-to-r from-gray-200 to-transparent dark:from-gray-800"></div>
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            @foreach ($work->images as $image)
            <div class="group relative rounded-2xl overflow-hidden aspect-video border border-gray-100 dark:border-gray-800 hover:shadow-xl hover:shadow-violet-500/10 transition-shadow">
                <img src="{{ Storage::url($image->path) }}" alt="{{ $image->caption ?? $work->title }}"
                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" />
            </div>
            @endforeach
        </div>
    </div>
    @endif

    </div>
</article>
@endsection
