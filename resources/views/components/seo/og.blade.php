@php
    $appName = (string) config('app.name');
    $defaultTitle = 'Ремонт бытовой техники на дому в Уфе — Сервисный центр «РемБытТехника»';
    $rawTitle = trim((string) ($title ?? ''));
    $hasTitle = $rawTitle !== '';
    $alreadyHasBrand = $hasTitle && mb_stripos($rawTitle, $appName) !== false;
    $metaTitle = $hasTitle
        ? ($alreadyHasBrand ? $rawTitle : $rawTitle . ' | ' . $appName)
        : $defaultTitle;
    $metaDescription = $description ?? 'Профессиональный ремонт бытовой техники в Уфе: выезд мастера, гарантия, диагностика.';
    $metaUrl = $ogUrl ?? $canonical ?? url()->current();
    $metaType = $ogType ?? 'website';
    $metaImage = $ogImage ?? asset('assets/images/hero.webp');
@endphp

<meta property="og:title" content="{{ $metaTitle }}">
<meta property="og:description" content="{{ $metaDescription }}">
<meta property="og:image" content="{{ $metaImage }}">
<meta property="og:url" content="{{ $metaUrl }}">
<meta property="og:type" content="{{ $metaType }}">
<meta property="og:site_name" content="{{ config('app.name') }}">
<meta property="og:locale" content="ru_RU">
