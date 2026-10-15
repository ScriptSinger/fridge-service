<?php

namespace Tests\Feature;

use App\Enums\LeadStatus;
use App\Models\Lead;
use App\Support\AccessLogReader;
use App\Support\AuthLogReader;
use Illuminate\Foundation\Testing\RefreshDatabase;
use MoonShine\Laravel\Models\MoonshineUser;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    private string $dir;

    protected function setUp(): void
    {
        parent::setUp();

        $this->dir = sys_get_temp_dir() . '/dashboard-test-' . uniqid();
        mkdir($this->dir);

        $now = now()->toIso8601String();
        file_put_contents($this->dir . '/access-' . now()->format('Y-m-d') . '.log', implode("\n", [
            json_encode(['datetime' => $now, 'context' => ['path' => '/boom', 'status' => 500]]),
            json_encode(['datetime' => $now, 'context' => ['path' => '/ok', 'status' => 200]]),
            json_encode(['datetime' => now()->subDays(3)->toIso8601String(), 'context' => ['path' => '/old', 'status' => 500]]),
        ]) . "\n");
        file_put_contents($this->dir . '/auth-' . now()->format('Y-m-d') . '.log', implode("\n", [
            json_encode(['message' => 'login_failed', 'datetime' => $now, 'context' => []]),
            json_encode(['message' => 'login', 'datetime' => $now, 'context' => []]),
        ]) . "\n");

        $this->app->instance(AccessLogReader::class, new AccessLogReader($this->dir));
        $this->app->instance(AuthLogReader::class, new AuthLogReader($this->dir));

        $this->actingAs(MoonshineUser::query()->create([
            'moonshine_user_role_id' => 1,
            'email' => 'a@example.com',
            'name' => 'A',
            'password' => bcrypt('x'),
        ]), 'moonshine');
    }

    protected function tearDown(): void
    {
        array_map('unlink', glob($this->dir . '/*'));
        rmdir($this->dir);

        parent::tearDown();
    }

    public function test_shows_the_queue_of_new_leads_and_skips_handled_ones(): void
    {
        $new = new Lead(['name' => 'Иван', 'phone' => '+79120000001', 'channel' => 'form', 'status' => LeadStatus::New]);
        $new->save();
        $handled = new Lead(['name' => 'Пётр', 'phone' => '+79120000002', 'channel' => 'form', 'status' => LeadStatus::Closed]);
        $handled->save();

        $this->get('/admin')
            ->assertOk()
            ->assertSee('Иван', false)
            ->assertDontSee('Пётр', false)
            ->assertSee('Новые заявки', false)
            ->assertSee('Ошибки 5xx за 24 ч', false)
            ->assertSee('Неудачных входов за 24 ч', false);
    }

    public function test_counts_only_recent_server_errors_and_failed_logins(): void
    {
        $this->assertSame(1, (new AuthLogReader($this->dir))->failedLoginsSince(now()->subDay()->getTimestamp()));

        $errors = (new AccessLogReader($this->dir))
            ->entries(['since' => now()->subDay()->getTimestamp()])
            ->filter(fn (array $row) => $row['status'] >= 500);

        $this->assertCount(1, $errors);
        $this->assertSame('/boom', $errors->first()['path']);
    }

    public function test_empty_queue_says_so(): void
    {
        $this->get('/admin')->assertOk()->assertSee('Новых заявок нет', false);
    }
}
