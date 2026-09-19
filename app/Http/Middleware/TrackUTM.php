<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class TrackUTM
{
    // Plain, JS-readable cookie (see bootstrap/app.php's encryptCookies
    // except list) — the lead form and contact-click beacon read it
    // client-side and send the values explicitly, because /api/leads and
    // /api/contact-clicks are stateless routes with no session access to
    // whatever this middleware captured on an earlier page view.
    public const COOKIE_NAME = 'utm_data';

    private const TTL_MINUTES = 60 * 24 * 30; // 30-day attribution window

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $hasExplicitUtm = $request->query('utm_source') !== null;
        $alreadyCaptured = $request->cookie(self::COOKIE_NAME) !== null;

        // First-touch attribution: once a visit is tagged, later internal
        // navigation (no query params, referer is our own site) must not
        // wipe it — only an explicit new ?utm_source= tag may override.
        if (! $hasExplicitUtm && $alreadyCaptured) {
            return $next($request);
        }

        $utmSource = $request->query('utm_source');
        $utmMedium = $request->query('utm_medium');
        $utmCampaign = $request->query('utm_campaign');

        if (! $utmSource && $referer = $request->headers->get('referer')) {
            if (str_contains($referer, 'google.com')) {
                $utmSource = 'google';
                $utmMedium = 'organic';
            } elseif (str_contains($referer, 'yandex.ru')) {
                $utmSource = 'yandex';
                $utmMedium = 'organic';
            }
        }

        if ($utmSource) {
            // httpOnly defaults to true on Cookie::make() — must be false
            // here, or the frontend's document.cookie read (utm.js) would
            // never see this cookie at all, silently breaking the beacon.
            Cookie::queue(Cookie::make(
                name: self::COOKIE_NAME,
                value: json_encode([
                    'utm_source' => $utmSource,
                    'utm_medium' => $utmMedium,
                    'utm_campaign' => $utmCampaign,
                ]),
                minutes: self::TTL_MINUTES,
                httpOnly: false,
            ));
        }

        return $next($request);
    }
}
