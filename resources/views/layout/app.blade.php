<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php
        $seoTitle = $seoTitle ?? 'Genesis Block | Market Education, Trading Tools & Insights';
        $seoDescription = $seoDescription ?? 'Explore market education, TradingView indicators, trade setup examples and practical resources from Genesis Block.';
        $seoCanonical = $seoCanonical ?? url()->current();
        $seoImage = $seoImage ?? null;
        $seoType = $seoType ?? 'website';
        $seoNoIndex = $seoNoIndex ?? request()->routeIs(
            'login', 'register', 'courses.index', 'journal', 'gallery', 'team-members',
            'resources', 'indicators.index', 'faqs', 'journey', 'news', 'account',
            'profile', 'indicators.payment-result', 'auth.google.*'
        );
        $seoGraph = [
            [
                '@type' => 'Organization',
                '@id' => route('home') . '#organization',
                'name' => config('app.name', 'Genesis Block'),
                'url' => route('home'),
                'logo' => asset('images/logo.png'),
            ],
            [
                '@type' => 'WebSite',
                '@id' => route('home') . '#website',
                'name' => config('app.name', 'Genesis Block'),
                'url' => route('home'),
                'publisher' => ['@id' => route('home') . '#organization'],
            ],
            ...($seoStructuredData ?? []),
        ];
    @endphp
    <title>{{ $seoTitle }}</title>
    <meta name="description" content="{{ $seoDescription }}">
    <meta name="robots" content="{{ $seoNoIndex ? 'noindex, nofollow' : 'index, follow' }}">
    <link rel="canonical" href="{{ $seoCanonical }}">
    <meta property="og:type" content="{{ $seoType }}">
    <meta property="og:site_name" content="{{ config('app.name', 'Genesis Block') }}">
    <meta property="og:title" content="{{ $seoTitle }}">
    <meta property="og:description" content="{{ $seoDescription }}">
    <meta property="og:url" content="{{ $seoCanonical }}">
    @if ($seoImage)
        <meta property="og:image" content="{{ $seoImage }}">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:image" content="{{ $seoImage }}">
    @else
        <meta name="twitter:card" content="summary">
    @endif
    <meta name="twitter:title" content="{{ $seoTitle }}">
    <meta name="twitter:description" content="{{ $seoDescription }}">
    <script type="application/ld+json">@json(['@context' => 'https://schema.org', '@graph' => $seoGraph], JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT)</script>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <div class="page-loader" data-page-loader aria-hidden="true">
        <div class="page-loader-mark"><img src="{{ asset('images/logo.png') }}" alt="Genesis Block"></div>
        <span class="page-loader-line"></span>
    </div>

    @include('partials.nav-header')

    {{ $slot }}

    @include('partials.footer')

    @include('partials.auth-modal')

    <!-- Bootstrap & jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="{{ asset('js/script.js') }}"></script>

</body>

</html>
