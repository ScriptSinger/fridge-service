<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Сервисный центр' }}</title>
    <meta name="description" content="{{ $description ?? '' }}">
    @vite('resources/css/app.css')
</head>

<body>

    @include('partials.header')

    <main>
        {{ $slot }}
    </main>

    @include('partials.footer')

    @vite('resources/js/app.js')
</body>

</html>
