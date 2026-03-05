@php
    $routeName = request()->route()?->getName();
    $isTechnicalRoute = request()->is('admin*')
        || request()->is('horizon*')
        || request()->is('telescope*')
        || str_starts_with((string) $routeName, 'moonshine.')
        || str_starts_with((string) $routeName, 'ignition.')
        || str_starts_with((string) $routeName, 'debugbar.');

    $isNoindex = ($noindex ?? false) || $isTechnicalRoute;
    $robotsContent = $isNoindex ? 'noindex, nofollow' : 'index, follow';
@endphp

<meta name="robots" content="{{ $robotsContent }}">
<meta name="googlebot" content="{{ $robotsContent }}">
