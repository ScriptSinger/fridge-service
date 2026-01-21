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
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite('resources/css/app.css')
</head>

<body>

    <x-layouts.header />

    <main>
        {{ $slot }}
    </main>

    <x-layouts.footer />

    @vite('resources/js/app.js')
</body>

</html>
