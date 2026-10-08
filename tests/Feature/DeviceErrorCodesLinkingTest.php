<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Device;
use App\Models\ErrorCode;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Error code pages were only linked from brand pages and got no search
 * impressions. The device hub now links to every active code of that device.
 */
class DeviceErrorCodesLinkingTest extends TestCase
{
    use RefreshDatabase;

    public function test_device_page_links_to_active_error_codes_grouped_by_brand(): void
    {
        $device = Device::create([
            'slug' => 'remont-stiralnyh-mashin',
            'permalink' => 'Стиральные машины',
            'type' => 'Стиральная машина',
            'h1' => 'Ремонт стиральных машин',
            'title' => 'Ремонт стиральных машин',
            'subtitle' => 'Выезд мастера на дом',
            'description' => 'Ремонт стиральных машин в Уфе',
            'is_active' => true,
        ]);
        $otherDevice = Device::create([
            'slug' => 'remont-holodilnikov',
            'permalink' => 'Холодильники',
            'type' => 'Холодильник',
            'is_active' => true,
        ]);
        $brand = Brand::create(['name' => 'Bosch', 'slug' => 'bosch', 'is_active' => true]);

        $active = ErrorCode::create([
            'device_id' => $device->id,
            'brand_id' => $brand->id,
            'code' => 'E18',
            'title' => 'Ошибка E18',
            'is_active' => true,
        ]);
        $inactive = ErrorCode::create([
            'device_id' => $device->id,
            'brand_id' => $brand->id,
            'code' => 'E99',
            'title' => 'Ошибка E99',
            'is_active' => false,
        ]);
        $otherDeviceCode = ErrorCode::create([
            'device_id' => $otherDevice->id,
            'brand_id' => $brand->id,
            'code' => 'F01',
            'title' => 'Ошибка F01',
            'is_active' => true,
        ]);

        $response = $this->get(route('devices.show', $device));

        $response->assertOk();
        $response->assertSee(route('error-codes.show', [$device, $active->slug]), false);
        $response->assertSee(route('devices.brands.show', [$device, $brand]) . '#error-codes', false);
        $response->assertDontSee(route('error-codes.show', [$device, $inactive->slug]), false);
        $response->assertDontSee(route('error-codes.show', [$otherDevice, $otherDeviceCode->slug]), false);
    }
}
