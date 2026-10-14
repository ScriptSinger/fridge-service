<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Device;
use App\Models\Gallery;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * A brand page shows only that brand's works — never other brands' — as plain
 * cards while they fit in one row, and as a slider from four works up.
 */
class BrandGalleryTest extends TestCase
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

    private function work(string $title, Brand $brand): void
    {
        Gallery::create([
            'title' => $title,
            'image' => 'gallery/' . md5($title) . '.jpg',
            'image_alt' => $title,
            'device_id' => $this->fridge->id,
            'brand_id' => $brand->id,
        ]);
    }

    public function test_few_works_are_own_only_and_shown_without_slider(): void
    {
        $biryusa = $this->brand('biryusa');
        $haier = $this->brand('haier');
        $this->work('Работа Бирюса', $biryusa);
        $this->work('Работа Haier', $haier);

        $response = $this->get(route('devices.brands.show', [$this->fridge, $biryusa]))->assertOk();

        $response->assertSee('Работа Бирюса');
        $response->assertDontSee('Работа Haier');
        $response->assertDontSee('x-ref="track"', false);
    }

    public function test_four_works_switch_to_slider(): void
    {
        $atlant = $this->brand('atlant');
        foreach (range(1, 4) as $i) {
            $this->work("Работа Атлант {$i}", $atlant);
        }

        $this->get(route('devices.brands.show', [$this->fridge, $atlant]))
            ->assertOk()
            ->assertSee('Работа Атлант 4')
            ->assertSee('x-ref="track"', false);
    }
}
