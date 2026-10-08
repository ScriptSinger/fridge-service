<?php

namespace Tests\Unit\Middleware;

use App\Http\Middleware\SecurityHeaders;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class SecurityHeadersTest extends TestCase
{
    private function handle(Request $request): Response
    {
        return (new SecurityHeaders())->handle($request, fn ($req) => new Response());
    }

    public function test_sets_hsts_and_nosniff_on_https(): void
    {
        $response = $this->handle(Request::create('https://service.ufamasters.ru/'));

        $this->assertSame('max-age=31536000', $response->headers->get('Strict-Transport-Security'));
        $this->assertSame('nosniff', $response->headers->get('X-Content-Type-Options'));
        // Webvisor replays visits in a frame on Yandex's domain.
        $this->assertFalse($response->headers->has('X-Frame-Options'));
    }

    public function test_skips_hsts_on_plain_http(): void
    {
        $response = $this->handle(Request::create('http://localhost/'));

        $this->assertFalse($response->headers->has('Strict-Transport-Security'));
        $this->assertSame('nosniff', $response->headers->get('X-Content-Type-Options'));
    }
}
