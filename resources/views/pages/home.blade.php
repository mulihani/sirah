@extends('layouts.app')

@section('title', __('navigation.home'))

@section('content')

    {{-- ══════════════════════════════════════════════════════════════════ --}}
    {{-- HERO SECTION --}}
    {{-- ══════════════════════════════════════════════════════════════════ --}}
    <section class="relative min-h-screen flex items-center overflow-hidden">

        {{-- Moving animated gradient background --}}
        <div
            class="absolute inset-0 bg-gradient-to-r from-violet-100 via-indigo-50 to-blue-100 dark:from-violet-950 dark:via-gray-900 dark:to-indigo-950 bg-[length:200%_200%] animate-gradient-x opacity-90">
        </div>

        {{-- Decorative blobs --}}
        <div
            class="absolute top-0 start-0 w-[600px] h-[600px] rounded-full bg-violet-300 dark:bg-violet-900/40 blur-[120px] opacity-30 -translate-x-1/2 -translate-y-1/2 pointer-events-none">
        </div>
        <div
            class="absolute bottom-0 end-0 w-[500px] h-[500px] rounded-full bg-indigo-300 dark:bg-indigo-900/40 blur-[100px] opacity-25 translate-x-1/3 translate-y-1/3 pointer-events-none">
        </div>

        <div class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="flex flex-col-reverse lg:flex-row items-center gap-12 lg:gap-20">

                {{-- ── Text Column ─────────────────────────────────── --}}
                <div class="flex-1 text-center lg:text-start">

                    {{-- Status badge --}}
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 mb-6 rounded-full
                                    bg-violet-100 dark:bg-violet-900/40
                                    text-violet-700 dark:text-violet-300
                                    text-sm font-medium
                                    border border-violet-200 dark:border-violet-800">
                        <span class="w-2 h-2 rounded-full bg-violet-500 animate-pulse"></span>
                        {{ __('app.tagline') }}
                    </div>

                    {{-- Name / Headline --}}
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-extrabold tracking-tight
                                   text-gray-900 dark:text-white leading-none mb-4">
                        {{ $profile?->title ?? \App\Models\Setting::get('owner_name', 'Sirah') }}
                    </h1>

                    {{-- Hero sub-title from profile with Typewriter --}}
                    @if ($profile?->hero_title)
                        <div class="text-2xl sm:text-3xl font-semibold text-violet-600 dark:text-violet-400 mb-4 h-10 flex flex-wrap justify-center lg:justify-start items-center" 
                             x-data="{ 
                                 text: '', 
                                 fullText: '{{ addslashes($profile->hero_title) }}', 
                                 i: 0,
                                 typeWriter() {
                                     if(this.i < this.fullText.length) {
                                         this.text += this.fullText.charAt(this.i);
                                         this.i++;
                                         setTimeout(() => this.typeWriter(), 100);
                                     }
                                 }
                             }" x-init="setTimeout(() => typeWriter(), 500)">
                            <span x-text="text" class="tracking-wide"></span>
                            <span class="inline-block w-[3px] h-7 sm:h-9 bg-violet-600 dark:bg-violet-400 ml-1.5 animate-pulse"></span>
                        </div>
                    @endif

                    @if ($profile?->hero_subtitle)
                        <p class="text-lg text-gray-500 dark:text-gray-400 max-w-xl mb-8 leading-relaxed
                                           mx-auto lg:mx-0">
                            {{ $profile->hero_subtitle }}
                        </p>
                    @else
                        <p class="text-lg text-gray-500 dark:text-gray-400 max-w-xl mb-8 leading-relaxed
                                           mx-auto lg:mx-0">
                            {{ __('app.tagline') }}
                        </p>
                    @endif

                    {{-- CTA Buttons --}}
                    <div class="flex flex-wrap justify-center lg:justify-start gap-4 mb-10">
                        <a href="{{ route('locale.works.index', ['locale' => $locale]) }}" class="px-8 py-3.5 rounded-xl bg-violet-600 hover:bg-violet-700
                                      text-white font-semibold
                                      transition-all duration-300
                                      hover:shadow-lg hover:shadow-violet-500/30 hover:-translate-y-0.5">
                            {{ __('navigation.works') }}
                        </a>
                        <a href="{{ route('locale.contact.show', ['locale' => $locale]) }}" class="px-8 py-3.5 rounded-xl
                                      border border-gray-200 dark:border-gray-700
                                      bg-white/80 dark:bg-gray-900/80 backdrop-blur-sm
                                      text-gray-800 dark:text-gray-200 font-semibold
                                      hover:border-violet-400 dark:hover:border-violet-500
                                      transition-all duration-300 hover:-translate-y-0.5">
                            {{ __('navigation.contact') }}
                        </a>
                    </div>

                    {{-- Social Links --}}
                    @if ($socialLinks->isNotEmpty())
                        <div class="flex justify-center lg:justify-start gap-5">
                            @foreach ($socialLinks as $link)
                                <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer" 
                                   class="group/social relative flex items-center justify-center w-10 h-10 rounded-xl bg-white/50 dark:bg-gray-800/50 backdrop-blur-sm border border-gray-200 dark:border-gray-700 hover:border-violet-500 dark:hover:border-violet-400 transition-all duration-300 hover:-translate-y-1"
                                   title="{{ $link->platform }}">
                                    @if ($link->icon)
                                        <i class="{{ $link->icon }} text-lg text-gray-500 dark:text-gray-400 group-hover/social:text-violet-600 dark:group-hover/social:text-violet-400 transition-colors"></i>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- ── Photo Column & Glassmorphism ─────────────────────────────────── --}}
                @if ($profile?->profile_photo)
                    <div class="flex-1 flex justify-center lg:justify-end w-full lg:max-w-none relative">
                        
                        {{-- Glassmorphism container --}}
                        <div class="relative p-3 sm:p-6 md:p-8 rounded-full bg-white/40 dark:bg-gray-900/40 backdrop-blur-xl border border-white/60 dark:border-gray-700/50 shadow-2xl overflow-hidden group animate-float">
                            {{-- Rotating background glow --}}
                            <div
                                class="absolute inset-0 bg-gradient-to-br from-violet-500/20 to-indigo-500/20 blur-3xl rounded-full opacity-70 group-hover:opacity-100 transition-opacity duration-700 z-0 scale-150 animate-[spin_10s_linear_infinite]">
                            </div>

                            {{-- Photo Image --}}
                            <div class="relative z-10 w-64 h-64 sm:w-80 sm:h-80 md:w-96 md:h-96 rounded-full
                                                ring-4 ring-white/60 dark:ring-violet-800/40
                                                overflow-hidden shadow-inner bg-white dark:bg-gray-800">
                                <img src="{{ Storage::disk('public')->url($profile->profile_photo) }}"
                                    alt="{{ $profile->title ?? \App\Models\Setting::get('owner_name') }}"
                                    class="w-full h-full object-cover object-top hover:scale-105 transition-transform duration-700" />
                            </div>
                        </div>

                    </div>
                @endif

            </div>

            {{-- ── Stats Bar ────────────────────────────────────────── --}}
            @if ($profile && is_array($profile->stats) && count($profile->stats) > 0)
                <div class="mt-20 grid grid-cols-2 sm:grid-cols-4 gap-6">
                    @foreach ($profile->stats as $stat)
                        <div class="text-center p-5 rounded-2xl
                                                bg-white/70 dark:bg-gray-900/70 backdrop-blur-sm
                                                border border-gray-100 dark:border-gray-800
                                                hover:border-violet-200 dark:hover:border-violet-800
                                                transition-all duration-300 hover:shadow-lg hover:shadow-violet-500/10">
                            <div class="text-3xl font-extrabold text-violet-600 dark:text-violet-400 mb-1">
                                {{ $stat['value'] ?? '' }}
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-400 font-medium">
                                {{ $stat['label'] ?? '' }}
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- ══════════════════════════════════════════════════════════════════ --}}
    {{-- SKILLS MARQUEE SECTION --}}
    {{-- ══════════════════════════════════════════════════════════════════ --}}
    @if (!empty($skills))
        @php
            $flatSkills = collect($skills)->collapse()->toArray();
        @endphp
        
        <div class="w-full bg-white dark:bg-gray-950 border-y border-gray-100 dark:border-gray-800 overflow-hidden py-8 lg:py-12 flex relative">
            
            {{-- Fade gradients for entering/exiting effect --}}
            <div class="absolute top-0 bottom-0 left-0 w-16 md:w-32 bg-gradient-to-r from-white to-transparent dark:from-gray-950 dark:to-transparent z-20 pointer-events-none"></div>
            <div class="absolute top-0 bottom-0 right-0 w-16 md:w-32 bg-gradient-to-l from-white to-transparent dark:from-gray-950 dark:to-transparent z-20 pointer-events-none"></div>

            <style>
                @keyframes marquee-ltr {
                    0% { transform: translateX(0); }
                    100% { transform: translateX(-50%); }
                }
                @keyframes marquee-rtl {
                    0% { transform: translateX(0); }
                    100% { transform: translateX(50%); }
                }
                .animate-marquee-scroll {
                    display: flex;
                    width: max-content;
                    animation: marquee-ltr 40s linear infinite;
                    z-index: 10;
                }
                html[dir="rtl"] .animate-marquee-scroll {
                    animation: marquee-rtl 40s linear infinite;
                }
                .animate-marquee-scroll:hover {
                    animation-play-state: paused;
                }
            </style>
            
            <div class="animate-marquee-scroll min-w-max">
                {{-- Loop enough times to create a seamless infinite loop --}}
                @for ($i = 0; $i < 4; $i++)
                    @foreach ($flatSkills as $skill)
                        <div class="flex items-center gap-3 px-8 sm:px-12 opacity-80 hover:opacity-100 hover:scale-110 transition-all duration-300 cursor-pointer group">
                            @if(!empty($skill['icon']))
                                <i class="{{ $skill['icon'] }} text-4xl sm:text-5xl text-gray-400 dark:text-gray-500 group-hover:text-violet-600 dark:group-hover:text-violet-400 drop-shadow-md transition-colors"></i>
                            @else
                                <div class="w-10 h-10 rounded-lg bg-gray-100 dark:bg-gray-800 flex items-center justify-center font-bold text-gray-400">
                                    {{ mb_substr($skill['name'], 0, 1) }}
                                </div>
                            @endif
                            <span class="text-2xl sm:text-3xl font-extrabold tracking-wide text-gray-400 dark:text-gray-600 group-hover:text-violet-600 dark:group-hover:text-violet-400 transition-colors">
                                {{ $skill['name'] }}
                            </span>
                        </div>
                    @endforeach
                @endfor
            </div>
        </div>
    @endif

    {{-- ══════════════════════════════════════════════════════════════════ --}}
    {{-- ABOUT ME SECTION --}}
    {{-- ══════════════════════════════════════════════════════════════════ --}}
    @if ($profile && ($profile->about_me || $profile->about_photo))
        <section class="py-24 relative overflow-hidden bg-gray-50 dark:bg-gray-900/50">
            
            {{-- Decorative ambient glow --}}
            <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-violet-400/10 dark:bg-violet-900/20 rounded-full blur-[100px] translate-x-1/2 -translate-y-1/2 pointer-events-none"></div>

            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

                {{-- Section header --}}
                <div class="text-center mb-16">
                    <span class="inline-block px-4 py-1.5 rounded-full text-xs font-bold tracking-widest uppercase
                                         bg-violet-100 dark:bg-violet-900/50 text-violet-600 dark:text-violet-400 mb-4 shadow-sm">
                        {{ __('app.about_me_title') }}
                    </span>
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-gray-900 dark:text-white">
                        {{ $profile?->about_title ?? __('app.about_me_title') }}
                    </h2>
                </div>

                <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-20">

                    {{-- About Photo --}}
                    @if ($profile->about_photo)
                        <div class="flex-shrink-0">
                            <div class="relative w-64 h-64 sm:w-80 sm:h-80 group">
                                {{-- Decorative floating background shape --}}
                                <div class="absolute inset-0 rounded-full bg-gradient-to-br from-violet-300 to-indigo-300 dark:from-violet-600 dark:to-indigo-600 blur-xl opacity-50 group-hover:opacity-70 group-hover:scale-105 transition-all duration-700 animate-[spin_15s_linear_infinite]"></div>
                                
                                {{-- Actual photo container --}}
                                <div class="relative w-full h-full rounded-full overflow-hidden shadow-2xl border-8 border-white dark:border-gray-800 z-10 group-hover:rotate-[-2deg] transition-transform duration-500">
                                    <img src="{{ Storage::disk('public')->url($profile->about_photo) }}"
                                        alt="{{ $profile->about_title ?? __('app.about_me_title') }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" />
                                </div>
                                
                                {{-- Floating decorative dots --}}
                                <div class="absolute -bottom-4 -left-4 w-12 h-12 rounded-full bg-violet-400 dark:bg-violet-600 border-4 border-white dark:border-gray-900 z-20 animate-float" style="animation-delay: 1s;"></div>
                                <div class="absolute -top-6 -right-2 w-8 h-8 rounded-full bg-indigo-400 dark:bg-indigo-600 border-4 border-white dark:border-gray-900 z-20 animate-float"></div>
                            </div>
                        </div>
                    @endif

                    {{-- About Text --}}
                    @if ($profile->about_me)
                        <div class="flex-1 space-y-6">
                            <div class="p-6 sm:p-8 rounded-3xl bg-white dark:bg-gray-800/80 shadow-xl shadow-violet-900/5 dark:shadow-black/20 border border-gray-100 dark:border-gray-700/50 backdrop-blur-sm relative overflow-hidden">
                                {{-- Subtle quote icon in background --}}
                                <svg class="absolute top-4 right-4 w-24 h-24 text-violet-50 dark:text-gray-700/30 -rotate-12" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>

                                <p class="text-lg text-gray-600 dark:text-gray-300 leading-relaxed whitespace-pre-line relative z-10">
                                    {{ $profile->about_me }}
                                </p>
                            </div>

                            @if($resume && $resume->is_active)
                                <div class="flex pt-4">
                                    <a href="{{ route('locale.resume', ['locale' => $locale]) }}" class="group relative inline-flex items-center justify-center gap-3 px-8 py-3.5 rounded-full bg-gray-900 dark:bg-white text-white dark:text-gray-900 font-bold overflow-hidden transition-all duration-300 hover:scale-105 hover:shadow-xl hover:shadow-gray-900/20 dark:hover:shadow-white/20">
                                        <span class="absolute inset-0 w-full h-full -mt-1 rounded-lg opacity-30 bg-gradient-to-b from-transparent via-transparent to-black"></span>
                                        <span class="relative flex items-center gap-2">
                                            {{ __('navigation.resume') }}
                                            <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                            </svg>
                                        </span>
                                    </a>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endif



    {{-- ══════════════════════════════════════════════════════════════════ --}}
    {{-- FEATURED WORKS --}}
    {{-- ══════════════════════════════════════════════════════════════════ --}}
    @if ($works->isNotEmpty())
        <section class="py-24 relative overflow-hidden bg-gray-50 dark:bg-gray-900/50">

            {{-- Decorative mesh grid pattern & ambient glow --}}
            <div class="absolute inset-0 bg-[linear-gradient(to_right,#80808012_1px,transparent_1px),linear-gradient(to_bottom,#80808012_1px,transparent_1px)] bg-[size:32px_32px]"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-violet-500/5 rounded-full blur-[120px] pointer-events-none"></div>

            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

                <div class="flex flex-col sm:flex-row items-start sm:items-end justify-between mb-16 gap-6">
                    <div>
                        <span class="inline-block px-4 py-1.5 rounded-full text-xs font-bold tracking-widest uppercase
                                             bg-violet-100 dark:bg-violet-900/50 text-violet-600 dark:text-violet-400 mb-4 shadow-sm animate-pulse">
                            {{ __('app.works_label') }}
                        </span>
                        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-gray-900 to-gray-500 dark:from-white dark:to-gray-400">
                            {{ __('works.title') }}
                        </h2>
                        <p class="text-lg text-gray-500 dark:text-gray-400 mt-4 max-w-2xl">{{ __('works.subtitle') }}</p>
                    </div>
                    <a href="{{ route('locale.works.index', ['locale' => $locale]) }}"
                        class="group relative inline-flex items-center gap-2 px-6 py-3 rounded-full bg-white dark:bg-gray-800 text-sm font-bold text-violet-600 dark:text-violet-400 border border-gray-200 dark:border-gray-700 hover:border-violet-500 transition-all duration-300 shadow-sm hover:shadow-lg hover:shadow-violet-500/20 hover:-translate-y-1 flex-shrink-0">
                        {{ __('app.read_more') }}
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>

                {{-- Bento-style works grid --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($works as $index => $work)
                        <a href="{{ route('locale.works.show', ['locale' => $locale, 'slug' => $work->slug]) }}" class="group bg-white dark:bg-gray-900 rounded-[2rem] overflow-hidden
                                              border border-gray-100 dark:border-gray-800
                                              hover:border-violet-300 dark:hover:border-violet-700
                                              transition-all duration-500
                                              hover:shadow-2xl hover:shadow-violet-500/20 hover:-translate-y-2
                                              {{ $index === 0 ? 'sm:col-span-2 lg:col-span-1' : '' }}">

                            {{-- Cover image / placeholder --}}
                            @if ($work->cover_image)
                                <div class="aspect-video overflow-hidden">
                                    <img src="{{ Storage::disk('public')->url($work->cover_image) }}" alt="{{ $work->title }}" class="w-full h-full object-cover
                                                                group-hover:scale-105 transition-transform duration-700" />
                                </div>
                            @else
                                <div class="aspect-video bg-gradient-to-br
                                                            from-violet-100 to-indigo-100
                                                            dark:from-violet-900/30 dark:to-indigo-900/30
                                                            flex items-center justify-center">
                                    <svg class="w-14 h-14 text-violet-300 dark:text-violet-700" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                </div>
                            @endif

                            <div class="p-5">
                                @if ($work->category)
                                    <span class="text-xs font-semibold text-violet-600 dark:text-violet-400 uppercase tracking-wider">
                                        {{ $work->category->name }}
                                    </span>
                                @endif
                                <h3 class="mt-1.5 font-semibold text-gray-900 dark:text-white
                                                       group-hover:text-violet-600 dark:group-hover:text-violet-400
                                                       transition-colors duration-300 line-clamp-2">
                                    {{ $work->title }}
                                </h3>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

@endsection