<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">

    @include('partials.seo-meta', ['meta' => $meta ?? []])

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
