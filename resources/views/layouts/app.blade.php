<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">
    @vite('resources/css/app.css')
</head>

<body>
    @include('partials.header')

    <main>
        {{ $slot }} {{-- сюда вставляется контент страницы --}}
    </main>

    @include('partials.footer')

    @vite('resources/js/app.js')
</body>

</html>
