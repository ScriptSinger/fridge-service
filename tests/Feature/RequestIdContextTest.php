<?php

namespace Tests\Feature;

use App\Http\Middleware\RequestIdMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Context;
use Illuminate\Support\Facades\Log;
use Monolog\Handler\TestHandler;
use Monolog\Logger;
use Tests\TestCase;

/**
 * The request id used to exist only in access.log, so an error in laravel.log
 * could not be tied to the request that caused it.
 */
class RequestIdContextTest extends TestCase
{
    public function test_request_id_is_shared_with_log_records_and_response_header(): void
    {
        $handler = new TestHandler();
        Log::swap(new \Illuminate\Log\LogManager($this->app));
        Log::extend('capture', fn () => new Logger('capture', [$handler]));
        config(['logging.channels.capture' => ['driver' => 'capture']]);

        $request = Request::create('/anything');
        $seen = null;

        $response = (new RequestIdMiddleware())->handle($request, function (Request $request) use (&$seen) {
            $seen = $request->attributes->get('request_id');
            Log::channel('capture')->error('boom');

            return response('ok');
        });

        $this->assertSame($seen, $response->headers->get('X-Request-ID'));
        $this->assertSame($seen, Context::get('request_id'));
        $this->assertSame($seen, $handler->getRecords()[0]->extra['request_id'] ?? null);
    }
}
