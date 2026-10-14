<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Device;
use App\Models\Gallery;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * A brand page shows its own works first and tops the row up with other
 * repairs of the same device, so brands with few works don't get a near-empty slider.
 */
class BrandGalleryFillTest extends TestCase
{
    use RefreshDatabase;

    private Device $fridge;

    protected function setUp(): void
    {
        parent::setUp();

        $this->fridge = Device::create([
            'slug' => 'remont-holodilnikov',
            'permalink' => 'Холодильники',
            'type' => 'Холодильник',
            'h1' => 'Ремонт холодильников',
            'subtitle' => 'Выезд мастера на дом',
            'title' => 'Ремонт холодильников',
            'description' => 'Ремонт холодильников в Уфе',
            'is_active' => true,
        ]);
    }

    private function brand(string $slug): Brand
    {
        $brand = Brand::create(['name' => ucfirst($slug), 'slug' => $slug, 'is_active' => true]);
        $this->fridge->brands()->attach($brand);

        return $brand;
    }

    private function work(string $title, ?Brand $brand, ?Device $device = null, int $order = 0): void
    {
        Gallery::create([
            'title' => $title,
            'image' => 'gallery/' . md5($title) . '.jpg',
            'image_alt' => $title,
            'device_id' => ($device ?? $this->fridge)->id,
            'brand_id' => $brand?->id,
            'sort_order' => $order,
        ]);
    }

    public function test_own_works_first_then_same_device_works_up_to_six(): void
    {
        $biryusa = $this->brand('biryusa');
        $atlant = $this->brand('atlant');
        $washer = Device::create(['slug' => 'remont-stiralnyh-mashin', 'permalink' => 'Стиралки', 'type' => 'Стиральная машина', 'is_active' => true]);

        $this->work('Работа Бирюса', $biryusa, order: 99);
        foreach (range(1, 7) as $i) {
            $this->work("Работа Атлант {$i}", $atlant, order: $i);
        }
        $this->work('Работа стиральной', null, $washer);

        $response = $this->get(route('devices.brands.show', [$this->fridge, $biryusa]))->assertOk();

        $response->assertSeeInOrder(['Работа Бирюса', 'Работа Атлант 1', 'Работа Атлант 5']);
        $response->assertDontSee('Работа Атлант 6');
        $response->assertDontSee('Работа стиральной');
    }

    public function test_brand_with_enough_works_shows_only_its_own(): void
    {
        $atlant = $this->brand('atlant');
        $biryusa = $this->brand('biryusa');

        foreach (range(1, 7) as $i) {
            $this->work("Работа Атлант {$i}", $atlant, order: $i);
        }
        $this->work('Работа Бирюса', $biryusa);

        $response = $this->get(route('devices.brands.show', [$this->fridge, $atlant]))->assertOk();

        $response->assertSee('Работа Атлант 7');
        $response->assertDontSee('Работа Бирюса');
    }
}
