<?php

namespace Tests\Feature;

use App\Models\Device;
use App\Models\Lead;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Phone/WhatsApp/Telegram clicks used to leave zero trace anywhere in the
 * system — only form submissions ever became a Lead. This endpoint records
 * that intent-only contact click so the admin sees real channel volume.
 */
class ContactClickTest extends TestCase
{
    use RefreshDatabase;

    public function test_records_a_channel_click_without_requiring_contact_info(): void
    {
        $response = $this->postJson('/api/contact-clicks', ['channel' => 'whatsapp']);

        $response->assertOk()->assertJsonPath('success', true);

        $this->assertDatabaseHas('leads', [
            'channel' => 'whatsapp',
            'phone' => null,
            'name' => null,
            'status' => 'new',
        ]);
    }

    public function test_records_a_vk_channel_click(): void
    {
        $response = $this->postJson('/api/contact-clicks', ['channel' => 'vk']);

        $response->assertOk()->assertJsonPath('success', true);

        $this->assertDatabaseHas('leads', [
            'channel' => 'vk',
            'phone' => null,
        ]);
    }

    public function test_rejects_an_unknown_channel(): void
    {
        $response = $this->postJson('/api/contact-clicks', ['channel' => 'carrier-pigeon']);

        $response->assertStatus(422);
        $this->assertDatabaseCount('leads', 0);
    }

    public function test_saves_utm_fields_when_posted(): void
    {
        // /api/contact-clicks is stateless (no session), so UTM values come
        // from the request body — the frontend reads them from the cookie
        // TrackUTM sets and sends them explicitly, see resources/js/lib/utm.js.
        $response = $this->postJson('/api/contact-clicks', [
            'channel' => 'phone',
            'utm_source' => 'yandex',
            'utm_medium' => 'cpc',
            'utm_campaign' => 'summer',
        ]);

        $response->assertOk();

        $this->assertDatabaseHas('leads', [
            'channel' => 'phone',
            'utm_source' => 'yandex',
            'utm_medium' => 'cpc',
            'utm_campaign' => 'summer',
        ]);
    }

    public function test_associates_the_leadable_when_provided(): void
    {
        $device = Device::create(['slug' => 'holodilniki', 'type' => 'Холодильник', 'is_active' => true]);

        $response = $this->postJson('/api/contact-clicks', [
            'channel' => 'telegram',
            'leadable_type' => Device::class,
            'leadable_id' => $device->id,
        ]);

        $response->assertOk();

        $lead = Lead::first();
        $this->assertSame(Device::class, $lead->leadable_type);
        $this->assertSame($device->id, $lead->leadable_id);
    }

    public function test_ignores_a_leadable_type_outside_the_whitelist(): void
    {
        $response = $this->postJson('/api/contact-clicks', [
            'channel' => 'phone',
            'leadable_type' => \App\Models\Lead::class,
            'leadable_id' => 1,
        ]);

        $response->assertStatus(422);
    }
}
