<!DOCTYPE html>
<html lang="ru">

@props(['title' => null, 'description' => null])

<head>
    <meta charset="UTF-8">
    @include('components.seo.base', ['title' => $title ?? null, 'description' => $description ?? null])
    @include('components.seo.canonical')
    @include('components.seo.og')
    @include('components.seo.robots')
    @include('components.seo.jsonld')

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    @vite('resources/css/app.css')
</head>

<body>

    <x-layouts.header />

    <main>
        {{ $slot }}
    </main>

    <x-layouts.footer />

    <x-ui.phone-cta variant="fab" />
    @vite('resources/js/app.js')
</body>

</html>
