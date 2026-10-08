<?php

namespace Tests\Feature;

use App\Models\Device;
use App\Models\Review;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Device hubs show reviews about that device first, while the aggregate
 * rating still counts every published review (same as the home page).
 */
class DeviceHubReviewsTest extends TestCase
{
    use RefreshDatabase;

    public function test_hub_lists_own_device_reviews_first_and_counts_all(): void
    {
        $fridge = Device::create([
            'slug' => 'remont-holodilnikov',
            'permalink' => 'Холодильники',
            'type' => 'Холодильник',
            'h1' => 'Ремонт холодильников',
            'subtitle' => 'Выезд мастера на дом',
            'title' => 'Ремонт холодильников',
            'description' => 'Ремонт холодильников в Уфе',
            'is_active' => true,
        ]);
        $washer = Device::create([
            'slug' => 'remont-stiralnyh-mashin',
            'permalink' => 'Стиральные машины',
            'type' => 'Стиральная машина',
            'is_active' => true,
        ]);

        $review = fn (string $name, ?int $deviceId, string $publishedAt) => Review::create([
            'name' => $name,
            'title' => $name,
            'text' => "Отзыв {$name}",
            'rating' => 5,
            'device_id' => $deviceId,
            'is_published' => true,
            'published_at' => $publishedAt,
        ]);

        // The newer washer review would come first by date alone.
        $review('Стиральщик', $washer->id, '2026-09-01');
        $review('Холодильщик', $fridge->id, '2026-01-01');
        Review::create([
            'name' => 'Черновик',
            'title' => 'Черновик',
            'text' => 'Не опубликован',
            'rating' => 1,
            'is_published' => false,
            'published_at' => '2026-09-02',
        ]);

        $response = $this->get(route('devices.show', $fridge));

        $response->assertOk();
        $response->assertSeeInOrder(['Холодильщик', 'Стиральщик']);
        $response->assertDontSee('Черновик');
        $response->assertSee('<meta itemprop="reviewCount" content="2">', false);
    }
}
