<!DOCTYPE html>
<html lang="ru">

@props([
    'title' => null,
    'description' => null,
    'canonical' => null,
    'ogImage' => null,
    'ogType' => 'website',
    'noindex' => false,
])
@php($yandexCounterId = env('YANDEX_METRIKA_ID'))

<head>
    <meta charset="UTF-8">
    @include('components.seo.base', ['title' => $title ?? null, 'description' => $description ?? null])
    @include('components.seo.canonical', ['canonical' => $canonical])
    @include('components.seo.og', [
        'title' => $title,
        'description' => $description,
        'ogImage' => $ogImage,
        'ogType' => $ogType,
        'canonical' => $canonical,
    ])
    @include('components.seo.robots', ['noindex' => $noindex])
    @include('components.seo.jsonld')

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="/favicon.ico" type="image/x-icon">

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">


    @vite('resources/css/app.css')
    @includeWhen(app()->environment('production'), 'components.analytics.metrika')
</head>

<body class="min-h-screen flex flex-col bg-white">
    @if ($yandexCounterId)
        <noscript>
            <div>
                <img src="https://mc.yandex.ru/watch/{{ $yandexCounterId }}" style="position:absolute; left:-9999px;"
                    alt="" />
            </div>
        </noscript>
    @endif

    <x-layouts.header />

    <main class="flex-1">
        {{ $slot }}
    </main>

    <x-layouts.footer />

    <x-ui.phone-cta variant="fab" />
    @vite('resources/js/app.js')
</body>

</html>
