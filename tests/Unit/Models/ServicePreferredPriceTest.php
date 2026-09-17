<?php

namespace Tests\Unit\Models;

use App\Models\Brand;
use App\Models\Price;
use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

/**
 * Service::preferredPrice() is a multi-step fallback chain (exact
 * device+brand -> brand-any-device -> device-general -> global-general ->
 * anything), the kind of logic that's easy to silently break while editing
 * pricing display. Locked down with plain in-memory models, no DB needed.
 */
class ServicePreferredPriceTest extends TestCase
{
    private function service(array $prices): Service
    {
        $service = new Service();
        $service->setRelation('prices', new Collection($prices));

        return $service;
    }

    private function price(array $attributes, array $brands = []): Price
    {
        $price = new Price($attributes);
        $price->setRelation('brands', new Collection($brands));

        return $price;
    }

    private function brand(int $id): Brand
    {
        $brand = new Brand(['name' => "Brand {$id}"]);
        $brand->setAttribute('id', $id);

        return $brand;
    }

    public function test_prefers_exact_device_and_brand_match(): void
    {
        $brandA = $this->brand(10);
        $exact = $this->price(['device_id' => 1, 'price_from' => 1000, 'units' => 'руб'], [$brandA]);
        $brandOnly = $this->price(['device_id' => 2, 'price_from' => 2000, 'units' => 'руб'], [$brandA]);
        $deviceGeneral = $this->price(['device_id' => 1, 'price_from' => 500, 'units' => 'руб']);

        $service = $this->service([$brandOnly, $deviceGeneral, $exact]);

        $this->assertSame($exact, $service->preferredPrice(deviceId: 1, brandId: 10));
    }

    public function test_falls_back_to_brand_match_on_another_device_when_no_exact_match(): void
    {
        $brandA = $this->brand(10);
        $brandOnOtherDevice = $this->price(['device_id' => 2, 'price_from' => 2000, 'units' => 'руб'], [$brandA]);
        $deviceGeneral = $this->price(['device_id' => 1, 'price_from' => 500, 'units' => 'руб']);

        $service = $this->service([$deviceGeneral, $brandOnOtherDevice]);

        $this->assertSame($brandOnOtherDevice, $service->preferredPrice(deviceId: 1, brandId: 10));
    }

    public function test_falls_back_to_device_general_price_when_brand_has_no_price_at_all(): void
    {
        $brandA = $this->brand(10);
        $otherBrandPrice = $this->price(['device_id' => 1, 'price_from' => 900, 'units' => 'руб'], [$this->brand(99)]);
        $deviceGeneral = $this->price(['device_id' => 1, 'price_from' => 500, 'units' => 'руб']);

        $service = $this->service([$otherBrandPrice, $deviceGeneral]);

        $this->assertSame($deviceGeneral, $service->preferredPrice(deviceId: 1, brandId: 10));
    }

    public function test_falls_back_to_global_general_price_when_no_device_general_exists(): void
    {
        $globalGeneral = $this->price(['device_id' => 2, 'price_from' => 700, 'units' => 'руб']);

        $service = $this->service([$globalGeneral]);

        $this->assertSame($globalGeneral, $service->preferredPrice(deviceId: 1, brandId: 10));
    }

    public function test_falls_back_to_any_price_as_last_resort(): void
    {
        $onlyPrice = $this->price(['device_id' => 2, 'price_from' => 700, 'units' => 'руб'], [$this->brand(99)]);

        $service = $this->service([$onlyPrice]);

        $this->assertSame($onlyPrice, $service->preferredPrice(deviceId: 1, brandId: 10));
    }

    public function test_returns_null_when_there_are_no_prices(): void
    {
        $service = $this->service([]);

        $this->assertNull($service->preferredPrice(deviceId: 1, brandId: 10));
    }

    public function test_without_brand_id_prefers_device_general_price(): void
    {
        $deviceGeneral = $this->price(['device_id' => 1, 'price_from' => 500, 'units' => 'руб']);
        $globalGeneral = $this->price(['device_id' => 2, 'price_from' => 700, 'units' => 'руб']);

        $service = $this->service([$globalGeneral, $deviceGeneral]);

        $this->assertSame($deviceGeneral, $service->preferredPrice(deviceId: 1));
    }

    public function test_prefers_priced_candidate_over_uncosted_one_within_the_same_tier(): void
    {
        $uncosted = $this->price(['device_id' => 1, 'price_from' => null, 'units' => 'руб']);
        $priced = $this->price(['device_id' => 1, 'price_from' => 500, 'units' => 'руб']);

        $service = $this->service([$uncosted, $priced]);

        $this->assertSame($priced, $service->preferredPrice(deviceId: 1));
    }
}
