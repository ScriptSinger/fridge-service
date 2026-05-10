@php($adsId = config('analytics.google_ads'))
@php($optOutCookie = config('analytics.opt_out_cookie'))
@if(app()->environment('production') && $adsId && !request()->hasCookie($optOutCookie))
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $adsId }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ $adsId }}');
    </script>
@endif
