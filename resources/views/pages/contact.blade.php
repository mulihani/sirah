@extends('layouts.app')

@section('title', __('contact.title'))

@section('content')
<div class="relative overflow-hidden min-h-[70vh]">
    {{-- Decorative mesh grid pattern & ambient glow --}}
    <div class="absolute inset-0 bg-[linear-gradient(to_right,#80808012_1px,transparent_1px),linear-gradient(to_bottom,#80808012_1px,transparent_1px)] bg-[size:32px_32px]"></div>
    <div class="absolute top-1/4 right-0 w-[500px] h-[500px] bg-violet-400/10 dark:bg-violet-900/20 rounded-full blur-[100px] translate-x-1/2 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-indigo-400/10 dark:bg-indigo-900/20 rounded-full blur-[100px] -translate-x-1/2 pointer-events-none"></div>

    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-20 relative z-10">

    <div class="mb-12 text-center">
        <span class="inline-block px-4 py-1.5 rounded-full text-xs font-bold tracking-widest uppercase bg-violet-100 dark:bg-violet-900/50 text-violet-600 dark:text-violet-400 mb-4 shadow-sm animate-pulse">
            {{ __('contact.title') }}
        </span>
        <h1 class="text-4xl sm:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-gray-900 to-gray-500 dark:from-white dark:to-gray-400">{{ __('contact.title') }}</h1>
        <p class="text-lg text-gray-500 dark:text-gray-400 mt-4">{{ __('contact.subtitle') }}</p>
    </div>

    {{-- Success / Error Messages --}}
    @if (session('success'))
    <div class="mb-8 p-4 rounded-xl bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-300 text-sm">
        {{ session('success') }}
    </div>
    @endif

    @if (session('error'))
    <div class="mb-8 p-4 rounded-xl bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-300 text-sm">
        {{ session('error') }}
    </div>
    @endif

    <div class="relative group">
        {{-- Animated Rotating Glow behind form --}}
        <div class="absolute -inset-1 bg-gradient-to-r from-violet-500 to-indigo-500 rounded-3xl blur opacity-20 group-hover:opacity-40 transition duration-1000 group-hover:duration-200 pointer-events-none"></div>
        
        <form action="{{ route('locale.contact.send', ['locale' => $locale]) }}" method="POST"
              class="relative space-y-6 bg-white/70 dark:bg-gray-900/70 backdrop-blur-xl rounded-[2rem] p-8 sm:p-10 border border-white/50 dark:border-gray-800 shadow-xl shadow-gray-200/20 dark:shadow-black/40">
        @csrf

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            {{-- Name --}}
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                    {{ __('contact.name') }} <span class="text-red-500">*</span>
                </label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                       class="w-full px-4 py-2.5 rounded-xl border @error('name') border-red-400 @else border-gray-200 dark:border-gray-700 @enderror bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-violet-500 focus:border-transparent outline-none transition-all" />
                @error('name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                    {{ __('contact.email') }} <span class="text-red-500">*</span>
                </label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                       class="w-full px-4 py-2.5 rounded-xl border @error('email') border-red-400 @else border-gray-200 dark:border-gray-700 @enderror bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-violet-500 focus:border-transparent outline-none transition-all" />
                @error('email') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Subject --}}
        <div>
            <label for="subject" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                {{ __('contact.subject') }} <span class="text-red-500">*</span>
            </label>
            <input type="text" id="subject" name="subject" value="{{ old('subject') }}" required
                   class="w-full px-4 py-2.5 rounded-xl border @error('subject') border-red-400 @else border-gray-200 dark:border-gray-700 @enderror bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-violet-500 focus:border-transparent outline-none transition-all" />
            @error('subject') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
        </div>

        {{-- Message --}}
        <div>
            <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                {{ __('contact.message') }} <span class="text-red-500">*</span>
            </label>
            <textarea id="message" name="message" rows="6" required
                      class="w-full px-4 py-2.5 rounded-xl border @error('message') border-red-400 @else border-gray-200 dark:border-gray-700 @enderror bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-violet-500 focus:border-transparent outline-none transition-all resize-none">{{ old('message') }}</textarea>
            @error('message') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
        </div>

            {{-- Submit --}}
            <button type="submit"
                    class="group relative w-full flex items-center justify-center gap-3 py-4 rounded-xl bg-violet-600 text-white font-bold overflow-hidden transition-all duration-300 hover:scale-[1.02] hover:shadow-xl hover:shadow-violet-600/30 ring-1 ring-white/10">
                <span class="absolute inset-0 w-full h-full -mt-1 rounded-lg opacity-30 bg-gradient-to-b from-transparent via-transparent to-black"></span>
                <span class="relative flex items-center gap-2">
                    {{ __('contact.send') }}
                    <svg class="w-5 h-5 transform group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                </span>
            </button>
        </form>
    </div>

    </div>
</div>
@endsection
