@php
    $currentLocale = app()->getLocale();
    $localesOptions = [
        'ar' => ['code' => 'ar', 'label' => 'العربية', 'short' => 'AR'],
        'en' => ['code' => 'en', 'label' => 'English', 'short' => 'EN'],
    ];

    $currentLabel = $localesOptions[$currentLocale]['label'] ?? $currentLocale;
    $currentShortName = $localesOptions[$currentLocale]['short'] ?? strtoupper($currentLocale);
@endphp

@if (count($localesOptions) > 1)
<x-filament::dropdown placement="bottom-end">
    <x-slot name="trigger">
        <x-filament::button
            color="gray"
            icon="heroicon-o-language"
            size="sm"
        >
            {{ $currentShortName }}
        </x-filament::button>
    </x-slot>

    <x-filament::dropdown.list>
        <x-filament::dropdown.header icon="heroicon-o-language">
            {{ __('admin.locale.switcher.current', ['language' => $currentLabel]) }}
        </x-filament::dropdown.header>
    </x-filament::dropdown.list>

    <x-filament::dropdown.list>
        @foreach ($localesOptions as $locale)
            <x-filament::dropdown.list.item
                :href="route('filament.' . filament()->getCurrentPanel()->getId() . '.locale.switch', ['lang' => $locale['code']])"
                :icon="$currentLocale === $locale['code'] ? 'heroicon-o-check' : 'heroicon-o-language'"
                tag="a"
            >
                {{ $locale['label'] }}
            </x-filament::dropdown.list.item>
        @endforeach
    </x-filament::dropdown.list>
</x-filament::dropdown>
@endif
