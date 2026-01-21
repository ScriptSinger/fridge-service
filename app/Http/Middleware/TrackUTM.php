<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackUTM
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $utmSource = $request->utm_source ?? null;
        $utmMedium = $request->utm_medium ?? null;
        $utmCampaign = $request->utm_campaign ?? null;

        // если UTM нет, пробуем определить через referer
        if (!$utmSource && $referer = $request->headers->get('referer')) {
            if (str_contains($referer, 'google.com')) {
                $utmSource = 'google';
                $utmMedium = 'organic';
            } elseif (str_contains($referer, 'yandex.ru')) {
                $utmSource = 'yandex';
                $utmMedium = 'organic';
            }
        }

        // сохраняем в сессию, чтобы формы могли использовать
        session([
            'utm_source' => $utmSource,
            'utm_medium' => $utmMedium,
            'utm_campaign' => $utmCampaign,
        ]);

        return $next($request);
    }
}
