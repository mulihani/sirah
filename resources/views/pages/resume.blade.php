@extends('layouts.app')

@section('title', __('resume.title'))

@section('content')
<div class="relative overflow-hidden min-h-[70vh]">
    {{-- Decorative ambient background --}}
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-violet-400/10 dark:bg-violet-900/20 rounded-full blur-[100px] translate-x-1/2 -translate-y-1/2 pointer-events-none"></div>
    <div class="absolute bottom-1/4 left-0 w-[400px] h-[400px] bg-indigo-400/10 dark:bg-indigo-900/20 rounded-full blur-[100px] -translate-x-1/2 pointer-events-none"></div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-20 relative z-10">

        <div class="mb-16 text-center">
            <span class="inline-block px-4 py-1.5 rounded-full text-xs font-bold tracking-widest uppercase bg-violet-100 dark:bg-violet-900/50 text-violet-600 dark:text-violet-400 mb-4 shadow-sm animate-pulse">
                {{ __('app.resume_label') ?? __('navigation.resume') }}
            </span>
            <h1 class="text-4xl sm:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-gray-900 to-gray-500 dark:from-white dark:to-gray-400">{{ __('resume.title') }}</h1>
        </div>

        @if (! $resume)
            <div class="text-center py-24 text-gray-400 dark:text-gray-600">
                <p>{{ __('resume.no_resume') }}</p>
            </div>
    @else

            {{-- PDF Download --}}
            @if ($resume->pdf_path)
            <div class="flex justify-center mb-16">
                <a href="{{ Storage::url($resume->pdf_path) }}" target="_blank"
                   class="group relative inline-flex items-center gap-3 px-8 py-3.5 rounded-full bg-violet-600 text-white font-bold overflow-hidden transition-all duration-300 hover:scale-105 hover:shadow-xl hover:shadow-violet-600/30">
                    <span class="absolute inset-0 w-full h-full -mt-1 rounded-lg opacity-30 bg-gradient-to-b from-transparent via-transparent to-black"></span>
                    <span class="relative flex items-center gap-2">
                        <svg class="w-5 h-5 group-hover:animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        {{ __('resume.download_pdf') }}
                    </span>
                </a>
            </div>
            @endif

            {{-- Summary --}}
            @if ($resume->summary)
            <section class="mb-16 p-8 rounded-[2rem] bg-white/60 dark:bg-gray-900/40 backdrop-blur-xl border border-violet-100 dark:border-gray-800 shadow-xl shadow-violet-500/5 group hover:border-violet-300 dark:hover:border-violet-700 transition-colors duration-500">
                <h2 class="text-sm font-bold tracking-widest text-violet-600 dark:text-violet-400 uppercase mb-4">{{ __('resume.summary') }}</h2>
                <p class="text-lg text-gray-700 dark:text-gray-300 leading-relaxed">{{ $resume->summary }}</p>
            </section>
            @endif

            {{-- Experience --}}
            @if ($resume->experience && count($resume->experience) > 0)
            <section class="mb-16">
                <div class="flex items-center gap-4 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ __('resume.experience') }}</h2>
                    <div class="h-px flex-1 bg-gradient-to-r from-violet-200 to-transparent dark:from-violet-900"></div>
                </div>
                <div class="space-y-8 relative before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:ml-6 md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-violet-500 before:via-violet-300 before:to-indigo-300 dark:before:from-violet-600 dark:before:to-indigo-900">
                    @foreach ($resume->experience as $exp)
                    <div class="relative flex items-start justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
                        {{-- Icon --}}
                        <div class="flex items-center justify-center w-10 h-10 rounded-full border-4 border-white dark:border-gray-950 bg-violet-100 dark:bg-violet-900 text-violet-600 dark:text-violet-400 shadow-sm shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 shadow-violet-500/20 group-hover:scale-110 transition-transform">
                            <div class="w-3 h-3 bg-violet-500 rounded-full group-hover:animate-ping"></div>
                        </div>
                        {{-- Content --}}
                        <div class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] p-6 rounded-2xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-sm group-hover:shadow-xl group-hover:shadow-violet-500/5 group-hover:-translate-y-1 transition-all duration-300">
                            <span class="font-semibold text-violet-600 dark:text-violet-400 tracking-wide text-sm">{{ $exp['period'] ?? '' }}</span>
                            <h3 class="font-bold text-xl text-gray-900 dark:text-white mt-1">{{ $exp['title'] ?? '' }}</h3>
                            <p class="text-gray-500 dark:text-gray-400 font-medium mb-3">{{ $exp['company'] ?? '' }}</p>
                            @if (! empty($exp['description']))
                            <p class="text-gray-600 dark:text-gray-300 leading-relaxed">{{ $exp['description'] }}</p>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
            @endif

        {{-- Education --}}
        @if ($resume->education && count($resume->education) > 0)
        <section class="mb-12">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6 pb-2 border-b border-gray-100 dark:border-gray-800">{{ __('resume.education') }}</h2>
            <div class="space-y-4">
                @foreach ($resume->education as $edu)
                <div class="flex gap-4">
                    <div class="w-2 h-2 mt-2 rounded-full bg-indigo-500 flex-shrink-0"></div>
                    <div>
                        <h3 class="font-semibold text-gray-900 dark:text-white">{{ $edu['degree'] ?? '' }}</h3>
                        <p class="text-sm text-indigo-600 dark:text-indigo-400">{{ $edu['institution'] ?? '' }}</p>
                        <p class="text-xs text-gray-400 dark:text-gray-500">{{ $edu['period'] ?? '' }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endif

        {{-- Skills --}}
        @if ($resume->skills && count($resume->skills) > 0)
        <section class="mb-16 bg-white dark:bg-gray-900 rounded-[2rem] p-8 sm:p-10 border border-gray-100 dark:border-gray-800 shadow-xl shadow-gray-200/20 dark:shadow-black/20">
            <div class="flex items-center gap-4 mb-8">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ __('resume.skills') }}</h2>
                <div class="h-px flex-1 bg-gradient-to-r from-violet-200 to-transparent dark:from-violet-900"></div>
            </div>
            
            @php
                $groupedSkills = collect($resume->skills)->groupBy(function ($skill) {
                    return $skill['category'] ?? 'general';
                });
                $skillCategories = \App\Models\Category::where('type', 'skill')->where('language', app()->getLocale())->pluck('name', 'slug');
            @endphp
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                @foreach ($groupedSkills as $category => $skills)
                <div class="bg-gray-50/50 dark:bg-gray-800/30 rounded-2xl p-6 border border-gray-100 dark:border-gray-800 hover:border-violet-200 dark:hover:border-violet-900/50 hover:shadow-lg hover:shadow-violet-500/5 transition-all duration-300">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-8 h-8 rounded-lg bg-violet-100 dark:bg-violet-900/40 flex items-center justify-center text-violet-600 dark:text-violet-400">
                            {{-- Generic Category Icon --}}
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                            </svg>
                        </div>
                        <h3 class="text-sm font-bold tracking-wider text-gray-900 dark:text-white uppercase">{{ $skillCategories->get($category) ?? (__('admin.fields.skill_cat_' . $category) === 'admin.fields.skill_cat_' . $category ? ucfirst($category) : __('admin.fields.skill_cat_' . $category)) }}</h3>
                    </div>
                    
                    <div class="space-y-3">
                        @foreach ($skills as $skill)
                        <div class="group relative flex items-center justify-between p-3.5 rounded-xl bg-white dark:bg-gray-950 border border-gray-100 dark:border-gray-800 hover:shadow-md hover:border-violet-200 dark:hover:border-violet-800 hover:-translate-y-0.5 transition-all duration-300">
                            <div class="flex items-center gap-3">
                                @if(!empty($skill['icon']))
                                    <div class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-50 dark:bg-gray-900 text-gray-700 dark:text-gray-300 group-hover:text-violet-600 dark:group-hover:text-violet-400 group-hover:bg-violet-50 dark:group-hover:bg-violet-900/30 transition-colors">
                                        <i class="{{ $skill['icon'] }} text-xl"></i>
                                    </div>
                                @else
                                    <div class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-50 dark:bg-gray-900">
                                        <div class="w-2 h-2 rounded-full bg-violet-500"></div>
                                    </div>
                                @endif
                                <span class="font-bold text-sm text-gray-800 dark:text-gray-200">{{ $skill['name'] ?? '' }}</span>
                            </div>
                            
                            @if (! empty($skill['level']))
                                @php
                                    $levelDots = match(strtolower($skill['level'])) {
                                        'beginner' => 1,
                                        'intermediate' => 2,
                                        'advanced' => 3,
                                        'expert' => 4,
                                        default => 0
                                    };
                                @endphp
                                @if($levelDots > 0)
                                <div class="flex gap-1.5 opacity-60 group-hover:opacity-100 transition-opacity" title="{{ ucfirst($skill['level']) }}">
                                    @for($i=1; $i<=4; $i++)
                                        <div class="w-1.5 h-1.5 rounded-full {{ $i <= $levelDots ? 'bg-violet-500 shadow-[0_0_8px_rgba(139,92,246,0.5)]' : 'bg-gray-200 dark:bg-gray-700' }}"></div>
                                    @endfor
                                </div>
                                @else
                                <span class="text-xs font-semibold px-2 py-1 rounded-md bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400">{{ $skill['level'] }}</span>
                                @endif
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endif

        {{-- Certifications --}}
        @if ($resume->certifications && count($resume->certifications) > 0)
        <section class="mb-12">
            <div class="flex items-center gap-4 mb-8">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ __('resume.certifications') }}</h2>
                <div class="h-px flex-1 bg-gradient-to-r from-violet-200 to-transparent dark:from-violet-900"></div>
            </div>
            @php
                $certCategories = \App\Models\Category::where('type', 'certification')->where('language', app()->getLocale())->pluck('name', 'slug');
            @endphp
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @foreach ($resume->certifications as $cert)
                <div class="group p-6 rounded-2xl bg-white dark:bg-gray-900 border border-gray-100 focus:outline-none hover:border-violet-300 dark:border-gray-800 dark:hover:border-violet-700 transition-all hover:shadow-lg hover:-translate-y-1">
                    <p class="font-bold text-gray-900 dark:text-white text-lg">{{ $cert['name'] ?? '' }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $cert['issuer'] ?? '' }}</p>
                    <div class="flex items-center gap-2 mt-3">
                        @if (! empty($cert['year']))
                        <p class="text-sm font-bold text-violet-600 dark:text-violet-400 inline-block px-3 py-1 bg-violet-50 dark:bg-violet-900/30 rounded-full">{{ $cert['year'] }}</p>
                        @endif
                        @if (! empty($cert['category']))
                        <p class="text-sm font-semibold text-gray-600 dark:text-gray-300 inline-block px-3 py-1 bg-gray-100 dark:bg-gray-800 rounded-full">{{ $certCategories->get($cert['category']) ?? $cert['category'] }}</p>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endif

    @endif

    </div>
</div>
@endsection
