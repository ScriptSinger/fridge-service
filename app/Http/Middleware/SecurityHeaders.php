<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Set here rather than in docker/nginx/default.conf: the deploy pipeline
 * doesn't recreate the nginx container for a config-only change, so headers
 * added there silently wouldn't ship.
 *
 * No X-Frame-Options / frame-ancestors on purpose: Metrika Webvisor replays
 * visits by framing the site from Yandex's domains.
 */
class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        /** @var Response $response */
        $response = $next($request);

        $response->headers->set('X-Content-Type-Options', 'nosniff');

        if ($request->isSecure()) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000');
        }

        return $response;
    }
}
