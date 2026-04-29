@extends('layouts.app')

@section('title', $page->title)

@section('content')
<article class="relative min-h-[70vh] overflow-hidden pb-20 pt-24">
    {{-- Decorative mesh grid pattern & ambient glow --}}
    <div class="absolute inset-0 bg-[linear-gradient(to_right,#80808012_1px,transparent_1px),linear-gradient(to_bottom,#80808012_1px,transparent_1px)] bg-[size:32px_32px]"></div>
    <div class="absolute top-0 center-0 w-[600px] h-[600px] bg-violet-400/10 dark:bg-violet-900/20 rounded-full blur-[120px] -translate-y-1/2 pointer-events-none"></div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        @if ($page->category)
        <span class="inline-block px-4 py-1.5 rounded-full text-xs font-bold bg-violet-100 dark:bg-violet-900/50 text-violet-600 dark:text-violet-400 uppercase tracking-widest shadow-sm mb-4">{{ $page->category->name }}</span>
        @endif
        <h1 class="text-4xl sm:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-gray-900 to-gray-500 dark:from-white dark:to-gray-400 mt-2 mb-12">{{ $page->title }}</h1>

        <div class="p-8 sm:p-12 rounded-[2rem] bg-white/70 dark:bg-gray-900/70 backdrop-blur-xl border border-white/50 dark:border-gray-800 shadow-xl shadow-gray-200/20 dark:shadow-black/40">
            <div class="prose prose-lg prose-gray dark:prose-invert max-w-none">
                {!! $page->content !!}
            </div>
        </div>
    </div>
</article>
@endsection
