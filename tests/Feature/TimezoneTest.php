<?php

namespace Tests\Feature;

use App\Enums\LeadStatus;
use App\Models\Lead;
use App\Support\AccessLogReader;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use MoonShine\Laravel\Models\MoonshineUser;
use Tests\TestCase;

class TimezoneTest extends TestCase
{
    use RefreshDatabase;

    public function test_mysql_session_zone_matches_the_app_zone(): void
    {
        // MySQL converts `timestamp` columns using the connection zone; if it
        // drifted from app.timezone, stored times would no longer read back
        // as the same wall clock they were written with.
        $this->assertSame(
            Carbon::now(config('app.timezone'))->format('P'),
            config('database.connections.mysql.timezone'),
        );
    }

    public function test_access_log_times_are_shown_in_the_app_zone(): void
    {
        $dir = sys_get_temp_dir() . '/tz-' . uniqid();
        mkdir($dir);
        file_put_contents($dir . '/access-2026-10-15.log', json_encode([
            'datetime' => '2026-10-15T10:56:07.000000+00:00',
            'context' => ['path' => '/', 'status' => 200],
        ]) . "\n");

        $row = (new AccessLogReader($dir))->entries()->first();

        $this->assertSame('15.10.2026 15:56:07', $row['time']);

        unlink($dir . '/access-2026-10-15.log');
        rmdir($dir);
    }

    public function test_lead_date_filter_includes_the_whole_last_day(): void
    {
        $this->actingAs(MoonshineUser::query()->create([
            'moonshine_user_role_id' => 1,
            'email' => 'a@example.com',
            'name' => 'A',
            'password' => bcrypt('x'),
        ]), 'moonshine');

        foreach ([
            '+79120000001' => '2026-10-14 23:30:00', // day before
            '+79120000002' => '2026-10-15 00:30:00', // first minutes of the day
            '+79120000003' => '2026-10-15 23:30:00', // last minutes of the day
            '+79120000004' => '2026-10-16 00:30:00', // day after
        ] as $phone => $createdAt) {
            $lead = new Lead(['phone' => $phone, 'channel' => 'form', 'status' => LeadStatus::New]);
            $lead->created_at = $createdAt;
            $lead->save();
        }

        $this->get('/admin/component/lead-index-page/lead-resource?_component_name=index-table-lead-resource&filter[created_at][from]=2026-10-15&filter[created_at][to]=2026-10-15')
            ->assertOk()
            ->assertSee('79120000002', false)
            ->assertSee('79120000003', false)
            ->assertDontSee('79120000001', false)
            ->assertDontSee('79120000004', false);
    }
}
