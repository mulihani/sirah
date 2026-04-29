<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    {{-- Static routes (home, works, resume, contact) for all locales --}}
    @foreach ($staticRoutes as $route)
    <url>
        <loc>{{ $route['url'] }}</loc>
        <changefreq>{{ $route['freq'] }}</changefreq>
        <priority>{{ $route['priority'] }}</priority>
    </url>
    @endforeach

    {{-- Dynamic work pages --}}
    @foreach ($workUrls as $entry)
    <url>
        <loc>{{ $entry['url'] }}</loc>
        @if(!empty($entry['lastmod']))
        <lastmod>{{ $entry['lastmod'] }}</lastmod>
        @endif
        <changefreq>{{ $entry['freq'] }}</changefreq>
        <priority>{{ $entry['priority'] }}</priority>
    </url>
    @endforeach

    {{-- Dynamic custom pages --}}
    @foreach ($pageUrls as $entry)
    <url>
        <loc>{{ $entry['url'] }}</loc>
        @if(!empty($entry['lastmod']))
        <lastmod>{{ $entry['lastmod'] }}</lastmod>
        @endif
        <changefreq>{{ $entry['freq'] }}</changefreq>
        <priority>{{ $entry['priority'] }}</priority>
    </url>
    @endforeach

</urlset>
