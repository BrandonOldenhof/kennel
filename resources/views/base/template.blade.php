<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page-title', config('app.name', 'Laravel'))</title>
    <meta name="robots" value="none" />

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicons/favicon-16x16.png">
    <link rel="manifest" href="/favicons/site.webmanifest">
    <link rel="mask-icon" href="/favicons/safari-pinned-tab.svg" color="#101521">
    <link rel="shortcut icon" href="/favicons/favicon.ico">
    <meta name="msapplication-TileColor" content="#101521">
    <meta name="msapplication-config" content="/favicons/browserconfig.xml">
    <meta name="theme-color" content="#101521">

    @if (config('rox.cookiebot') !== '')
        {{-- Cookiebot
        Contact the PM for account details and the license key
        More info at: https://www.cookiebot.com/en/help/ --}}
        <script id="Cookiebot" src="https://consent.cookiebot.com/uc.js" data-cbid="{{ config('rox.cookiebot') }}"
                type="text/javascript" data-blockingmode="auto" crossorigin="anonymous" nonce="{{ csrf_token() }}"></script>
    @endif

    <!-- Styles -->
    <link rel="preconnect" href="https://rsms.me">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css"
        integrity="sha384-PaFjJrzfQNIUio6v7L2ocT4gPOJwuI/678L24xIx66OZPjJioxEnomDejMBYRVe2" crossorigin="anonymous">

    <!-- Fontawesome -->
    {{-- <link rel="stylesheet" href="{{ mix('css/fontawesome.css') }}"> --}}

    @if (config('rox.google.gtm') !== '')
        <!-- Google Tag Manager -->
        <x-analytics.gtm.script />
    @endif

    @if (config('rox.google.ga') !== '')
        <!-- Google Analytics 4 -->
        <x-analytics.ga.script />
    @endif

    <link rel="stylesheet" href="{{ mix('css/tailwind.css') }}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @stack('styles')
</head>

<body>
    @if (config('rox.google.gtm') !== '')
        <!-- Google Tag Manager -->
        <x-analytics.gtm.no-script />
    @endif

    <a href="#content" class="sr-only">Skip to main content</a>

    @yield('navigation')

    <main id="content">
        @yield('content')
    </main>

    <script src="{{ mix('js/app.js') }}" defer></script>
    @stack('scripts')

    @if (config('app.env') === 'local')
        <script id="__bs_script__">
            //<![CDATA[
            document.write(
                "<script async src='https://HOST:3000/browser-sync/browser-sync-client.js?v=2.27.7' nonce='{{ csrf_token() }}'><\/script>"
                .replace("HOST", location.hostname));
            //]]>
        </script>
    @endif

    @if (config('rox.accessibility') === true && config('app.env') !== 'production')
        <script src="{{ mix('js/axe.js') }}" defer></script>
    @endif
</body>

</html>
