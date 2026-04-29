@extends('layouts.app')

@section('title', __('works.title'))

@section('content')
<div class="relative overflow-hidden min-h-[60vh]">
    {{-- Decorative mesh grid pattern & ambient glow --}}
    <div class="absolute inset-0 bg-[linear-gradient(to_right,#80808012_1px,transparent_1px),linear-gradient(to_bottom,#80808012_1px,transparent_1px)] bg-[size:32px_32px]"></div>
    <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-violet-400/10 dark:bg-violet-900/20 rounded-full blur-[100px] translate-x-1/3 -translate-y-1/3 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-indigo-400/10 dark:bg-indigo-900/20 rounded-full blur-[100px] -translate-x-1/3 translate-y-1/3 pointer-events-none z-0"></div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-20 relative z-10">

        <div class="mb-16 text-center lg:text-start">
            <span class="inline-block px-4 py-1.5 rounded-full text-xs font-bold tracking-widest uppercase
                                 bg-violet-100 dark:bg-violet-900/50 text-violet-600 dark:text-violet-400 mb-4 shadow-sm animate-pulse">
                {{ __('app.works_label') }}
            </span>
            <h1 class="text-4xl sm:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-gray-900 to-gray-500 dark:from-white dark:to-gray-400">{{ __('works.title') }}</h1>
            <p class="text-lg text-gray-500 dark:text-gray-400 mt-4 max-w-2xl mx-auto lg:mx-0">{{ __('works.subtitle') }}</p>
        </div>

        @if ($works->isEmpty())
        <div class="text-center py-24 text-gray-400 dark:text-gray-600">
            <svg class="w-16 h-16 mx-auto mb-4 opacity-30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
            </svg>
            <p>{{ __('works.no_works') }}</p>
        </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($works as $index => $work)
                <a href="{{ route('locale.works.show', ['locale' => $locale, 'slug' => $work->slug]) }}"
                   class="group bg-white dark:bg-gray-900 rounded-[2rem] overflow-hidden border border-gray-100 dark:border-gray-800 hover:border-violet-300 dark:hover:border-violet-700 transition-all duration-500 hover:shadow-2xl hover:shadow-violet-500/20 hover:-translate-y-2 relative z-10">
    
                    @if ($work->cover_image)
                    <div class="aspect-video overflow-hidden relative">
                        <div class="absolute inset-0 bg-violet-500/10 group-hover:bg-transparent transition-colors z-10 pointer-events-none"></div>
                        <img src="{{ Storage::url($work->cover_image) }}" alt="{{ $work->title }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" />
                    </div>
                    @else
                    <div class="aspect-video bg-gradient-to-br from-violet-100 to-indigo-100 dark:from-violet-900/20 dark:to-indigo-900/20 group-hover:scale-105 transition-transform duration-700"></div>
                    @endif
    
                    <div class="p-6 sm:p-8">
                        @if ($work->category)
                        <span class="inline-block px-3 py-1 rounded-full text-xs font-bold text-violet-600 dark:text-violet-400 bg-violet-50 dark:bg-violet-900/30 uppercase tracking-wider mb-3 transition-colors group-hover:bg-violet-100 dark:group-hover:bg-violet-900/50">{{ $work->category->name }}</span>
                        @endif
                        <h2 class="font-bold text-xl text-gray-900 dark:text-white group-hover:text-violet-600 dark:group-hover:text-violet-400 transition-colors line-clamp-2">
                            {{ $work->title }}
                        </h2>
                    </div>
                </a>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
