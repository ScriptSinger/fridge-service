<?php

namespace Tests\Feature;

use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

/**
 * Admin sign-ins, failed attempts and sign-outs go to the `auth` channel so
 * a brute-force on /admin is visible. The password must never reach the log.
 */
class AdminAuthLogTest extends TestCase
{
    public function test_failed_admin_login_is_logged_without_the_password(): void
    {
        $logged = null;
        Log::swap(new class ($logged) {
            public function __construct(public mixed &$logged) {}

            public function channel(string $name): static
            {
                return $this;
            }

            public function warning(string $message, array $context = []): void
            {
                $this->logged = [$message, $context];
            }

            public function info(string $message, array $context = []): void
            {
                $this->logged = [$message, $context];
            }
        });

        Event::dispatch(new Failed('moonshine', null, [
            'email' => 'admin@example.com',
            'password' => 'secret-pass',
        ]));

        $this->assertSame('login_failed', $logged[0]);
        $this->assertSame('admin@example.com', $logged[1]['login']);
        $this->assertFalse($logged[1]['user_exists']);
        $this->assertStringNotContainsString('secret-pass', json_encode($logged));
    }

    public function test_login_and_logout_record_the_user_id(): void
    {
        $messages = [];
        Log::swap(new class ($messages) {
            public function __construct(public array &$messages) {}

            public function channel(string $name): static
            {
                return $this;
            }

            public function info(string $message, array $context = []): void
            {
                $this->messages[] = [$message, $context];
            }
        });

        $user = new User();
        $user->id = 7;

        Event::dispatch(new Login('moonshine', $user, false));
        Event::dispatch(new Logout('moonshine', $user));

        $this->assertSame('login', $messages[0][0]);
        $this->assertSame(7, $messages[0][1]['user_id']);
        $this->assertSame('logout', $messages[1][0]);
    }

    public function test_other_guards_are_ignored(): void
    {
        $messages = [];
        Log::swap(new class ($messages) {
            public function __construct(public array &$messages) {}

            public function channel(string $name): static
            {
                return $this;
            }

            public function info(string $message, array $context = []): void
            {
                $this->messages[] = $message;
            }
        });

        Event::dispatch(new Login('web', new User(), false));

        $this->assertSame([], $messages);
    }
}
