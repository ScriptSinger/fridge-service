<?php

namespace Tests\Unit\Middleware;

use App\Http\Middleware\TrackUTM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

/**
 * TrackUTM used to write into the session, which /api/leads and
 * /api/contact-clicks (stateless routes) could never actually read — every
 * lead ended up with null UTM regardless of the real campaign source. It now
 * writes a plain cookie the frontend reads and sends explicitly instead.
 */
class TrackUTMTest extends TestCase
{
    private TrackUTM $middleware;

    protected function setUp(): void
    {
        parent::setUp();

        $this->middleware = new TrackUTM();
    }

    private function handle(Request $request): void
    {
        $this->middleware->handle($request, fn ($req) => new Response());
    }

    private function queuedUtm(): ?array
    {
        $cookie = Cookie::queued(TrackUTM::COOKIE_NAME);

        return $cookie ? json_decode($cookie->getValue(), true) : null;
    }

    public function test_captures_explicit_utm_query_params(): void
    {
        $this->handle(Request::create('/?utm_source=yandex&utm_medium=cpc&utm_campaign=summer'));

        $this->assertSame(
            ['utm_source' => 'yandex', 'utm_medium' => 'cpc', 'utm_campaign' => 'summer'],
            $this->queuedUtm(),
        );
    }

    public function test_infers_source_from_google_referer(): void
    {
        $this->handle(Request::create('/', 'GET', server: ['HTTP_REFERER' => 'https://www.google.com/search?q=x']));

        $utm = $this->queuedUtm();

        $this->assertSame('google', $utm['utm_source']);
        $this->assertSame('organic', $utm['utm_medium']);
    }

    public function test_infers_source_from_yandex_referer(): void
    {
        $this->handle(Request::create('/', 'GET', server: ['HTTP_REFERER' => 'https://yandex.ru/search/?text=x']));

        $utm = $this->queuedUtm();

        $this->assertSame('yandex', $utm['utm_source']);
        $this->assertSame('organic', $utm['utm_medium']);
    }

    public function test_does_not_set_a_cookie_without_utm_or_a_matching_referer(): void
    {
        $this->handle(Request::create('/'));

        $this->assertFalse(Cookie::hasQueued(TrackUTM::COOKIE_NAME));
    }

    public function test_preserves_first_touch_on_plain_internal_navigation(): void
    {
        $request = Request::create('/some-other-page');
        $request->cookies->set(TrackUTM::COOKIE_NAME, json_encode([
            'utm_source' => 'yandex', 'utm_medium' => 'cpc', 'utm_campaign' => 'summer',
        ]));

        $this->handle($request);

        $this->assertFalse(Cookie::hasQueued(TrackUTM::COOKIE_NAME));
    }

    public function test_explicit_utm_overrides_an_already_captured_cookie(): void
    {
        $request = Request::create('/?utm_source=google&utm_medium=cpc&utm_campaign=autumn');
        $request->cookies->set(TrackUTM::COOKIE_NAME, json_encode([
            'utm_source' => 'yandex', 'utm_medium' => 'cpc', 'utm_campaign' => 'summer',
        ]));

        $this->handle($request);

        $this->assertSame(
            ['utm_source' => 'google', 'utm_medium' => 'cpc', 'utm_campaign' => 'autumn'],
            $this->queuedUtm(),
        );
    }
}
