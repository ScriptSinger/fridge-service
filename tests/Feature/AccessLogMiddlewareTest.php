<?php

namespace Tests\Feature;

use App\Http\Middleware\AccessLogMiddleware;
use Illuminate\Http\Request;
use ReflectionMethod;
use Tests\TestCase;

class AccessLogMiddlewareTest extends TestCase
{
    private function invokePrivate(string $method, mixed ...$args): mixed
    {
        $reflection = new ReflectionMethod(AccessLogMiddleware::class, $method);

        return $reflection->invoke(new AccessLogMiddleware(), ...$args);
    }

    public function test_static_directories_are_skipped_by_whole_segment_only(): void
    {
        foreach (['/favicon.ico', '/css', '/css/app.css', '/js/app.js', '/Images/logo.png'] as $path) {
            $this->assertTrue($this->invokePrivate('shouldSkip', $path), $path);
        }

        foreach (['/jsonld-demo', '/images-gallery', '/cssomething', '/remont-holodilnikov'] as $path) {
            $this->assertFalse($this->invokePrivate('shouldSkip', $path), $path);
        }
    }

    public function test_query_string_is_logged_and_capped(): void
    {
        $this->assertSame(
            // Symfony normalises the query string, sorting parameters by name.
            'utm_medium=cpc&utm_source=yandex',
            $this->invokePrivate('query', Request::create('/x?utm_source=yandex&utm_medium=cpc')),
        );
        $this->assertNull($this->invokePrivate('query', Request::create('/x')));

        $long = $this->invokePrivate('query', Request::create('/x?q=' . str_repeat('a', 2000)));
        $this->assertLessThanOrEqual(501, mb_strlen($long));
    }
}
