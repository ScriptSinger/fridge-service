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
}
