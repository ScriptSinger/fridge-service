@php
    $appName = (string) config('app.name');
    $defaultTitle = 'Ремонт бытовой техники на дому в Уфе — Сервисный центр «РемБытТехника»';
    $rawTitle = trim((string) ($title ?? ''));
    $hasTitle = $rawTitle !== '';
    $alreadyHasBrand = $hasTitle && mb_stripos($rawTitle, $appName) !== false;

    $fullTitle = $hasTitle
        ? ($alreadyHasBrand ? $rawTitle : $rawTitle . ' | ' . $appName)
        : $defaultTitle;
@endphp

<title>{{ $fullTitle }}</title>

@if (!empty($description))
    <meta name="description" content="{{ $description }}">
@endif
