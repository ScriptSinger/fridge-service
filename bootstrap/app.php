<?php

use App\Http\Middleware\AccessLogMiddleware;
use App\Http\Middleware\RequestIdMiddleware;
use App\Http\Middleware\TrackUTM;
use App\Models\Redirect;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request as HttpRequest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->trustProxies(
            at: '*',
            headers: Request::HEADER_X_FORWARDED_FOR
                | Request::HEADER_X_FORWARDED_HOST
                | Request::HEADER_X_FORWARDED_PORT
                | Request::HEADER_X_FORWARDED_PROTO
        );

        // Read via raw document.cookie by the lead-form/contact-click JS, so
        // Laravel must not try to decrypt it (it would silently null out any
        // value it can't decrypt). Kept as a literal in sync by hand with
        // TrackUTM::COOKIE_NAME, matching how 'cookie_consent' was handled
        // here previously — config() isn't available this early either.
        $middleware->encryptCookies(except: [
            'utm_data',
        ]);

        $middleware->web(append: [
            TrackUTM::class,
            RequestIdMiddleware::class,
            AccessLogMiddleware::class,
        ]);
        $middleware->api(append: [
            RequestIdMiddleware::class,
            AccessLogMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Slug changes on Problem/ErrorCode/Service/Gallery record a 301
        // here instead of leaving an already-indexed URL to 404, since the
        // route pattern always matches and it's the model lookup inside the
        // controller that fails — Route::fallback never sees these.
        $exceptions->render(function (NotFoundHttpException $e, HttpRequest $request) {
            $redirect = Redirect::query()->where('from_path', $request->getPathInfo())->first();

            if ($redirect) {
                return redirect($redirect->to_path, 301);
            }
        });
    })->create();
