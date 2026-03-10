@php($counter = config('analytics.yandex_metrika'))
@php($excludeIps = config('analytics.exclude_ips', []))
@php($optOutCookie = config('analytics.opt_out_cookie'))
@if(app()->environment('production') && $counter && ! in_array(request()->ip(), $excludeIps) && ! request()->hasCookie($optOutCookie))
    <script type="text/javascript">
        (function(m,e,t,r,i,k,a){
            m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
            m[i].l=1*new Date();
            for (var j=0; j<document.scripts.length; j++) {
                if (document.scripts[j].src===r) return;
            }
            k=e.createElement(t);a=e.getElementsByTagName(t)[0];k.async=1;k.src=r;a.parentNode.insertBefore(k,a);
        })(window, document, 'script', "https://mc.yandex.ru/metrika/tag.js?id={{ $counter }}", 'ym');

        ym({{ $counter }}, 'init', {
            webvisor: true,
            clickmap: true,
            ecommerce: 'dataLayer',
            accurateTrackBounce: true,
            trackLinks: true,
        });

        const sendSPAHit = () => ym({{ $counter }}, 'hit', location.pathname + location.search);
        window.addEventListener('popstate', sendSPAHit);
        window.addEventListener('hashchange', sendSPAHit);
        document.addEventListener('DOMContentLoaded', () => {
            if (window.history && history.pushState) {
                const originalPush = history.pushState;
                history.pushState = function() {
                    originalPush.apply(this, arguments);
                    sendSPAHit();
                };
            }
        });
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/{{ $counter }}" style="position:absolute; left:-9999px;" alt="Yandex.Metrika"></div></noscript>
@endif
