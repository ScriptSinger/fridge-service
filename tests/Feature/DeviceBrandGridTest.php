<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Device;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Brand links on a device hub must be visible links in the markup,
 * not a JS-only search box backed by a screen-reader-only list.
 */
class DeviceBrandGridTest extends TestCase
{
    use RefreshDatabase;

    public function test_hub_renders_visible_brand_links(): void
    {
        $device = Device::create([
            'slug' => 'remont-holodilnikov',
            'permalink' => 'Холодильники',
            'type' => 'Холодильник',
            'h1' => 'Ремонт холодильников',
            'subtitle' => 'Выезд мастера на дом',
            'title' => 'Ремонт холодильников',
            'description' => 'Ремонт холодильников в Уфе',
            'is_active' => true,
        ]);
        $brand = Brand::create(['name' => 'Atlant', 'name_ru' => 'Атлант', 'slug' => 'atlant', 'is_active' => true]);
        $device->brands()->attach($brand);

        $response = $this->get(route('devices.show', $device));

        $response->assertOk();
        $response->assertSee('href="' . route('devices.brands.show', [$device->slug, $brand->slug]) . '"', false);
        $response->assertSeeInOrder(['Atlant', 'Атлант', 'Не нашли свой бренд?']);
        $response->assertDontSee('sr-only" aria-label="Ссылки на страницы брендов', false);
    }

    public function test_brands_follow_per_device_sort_order(): void
    {
        $device = Device::create([
            'slug' => 'remont-stiralnyh-mashin',
            'permalink' => 'Стиральные машины',
            'type' => 'Стиральная машина',
            'h1' => 'Ремонт стиральных машин',
            'subtitle' => 'Выезд мастера на дом',
            'title' => 'Ремонт стиральных машин',
            'description' => 'Ремонт стиральных машин в Уфе',
            'is_active' => true,
        ]);
        // Created first, so it would lead by id alone.
        $atlant = Brand::create(['name' => 'Atlant', 'slug' => 'atlant', 'is_active' => true]);
        $lg = Brand::create(['name' => 'LG', 'slug' => 'lg', 'is_active' => true]);
        $device->brands()->attach($atlant, ['sort_order' => 20]);
        $device->brands()->attach($lg, ['sort_order' => 10]);

        $this->get(route('devices.show', $device))
            ->assertOk()
            ->assertSeeInOrder(['/remont-stiralnyh-mashin/lg"', '/remont-stiralnyh-mashin/atlant"'], false);
    }
}
