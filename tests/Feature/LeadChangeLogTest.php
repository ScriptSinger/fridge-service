<?php

namespace Tests\Feature;

use App\Models\Lead;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Queue;
use MoonShine\Laravel\Models\MoonshineUser;
use Tests\TestCase;

class LeadChangeLogTest extends TestCase
{
    use RefreshDatabase;

    public function test_lead_form_renders_with_change_log_rows(): void
    {
        Http::fake();
        Queue::fake();

        $user = MoonshineUser::query()->create([
            'moonshine_user_role_id' => 1,
            'email' => 'a@example.com',
            'name' => 'A',
            'password' => bcrypt('x'),
        ]);
        $this->actingAs($user, 'moonshine');

        $lead = Lead::query()->create(['name' => 'Ivan', 'phone' => '+79000000000', 'status' => 'new']);

        // HasChangeLog only records inside MoonShine requests, so seed the row.
        $lead->changeLogs()->create([
            'moonshine_user_id' => $user->getKey(),
            'states_before' => ['status' => 'new'],
            'states_after' => ['status' => 'in_progress'],
        ]);

        $this->get('/admin/resource/lead-resource/lead-form-page/' . $lead->getKey())
            ->assertOk()
            ->assertSee('История изменений');
    }
}
