<?php

namespace Tests\Unit\Services;

use App\Models\Brand;
use App\Models\Device;
use App\Models\ErrorCode;
use App\Models\Gallery;
use App\Models\Problem;
use App\Models\Service;
use App\Services\BreadcrumbParentResolver;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

class BreadcrumbParentResolverTest extends TestCase
{
    private BreadcrumbParentResolver $resolver;

    protected function setUp(): void
    {
        parent::setUp();

        $this->resolver = new BreadcrumbParentResolver();
    }

    public function test_brand_specific_problem_parents_through_its_first_brand(): void
    {
        $device = new Device(['slug' => 'stiralnie-mashiny']);
        $brand = new Brand(['name' => 'Bosch', 'slug' => 'bosch']);

        $problem = new Problem();
        $problem->setRelation('brands', new Collection([$brand]));

        $target = $this->resolver->forProblem($problem, $device);

        $this->assertSame('devices.brands.show', $target->parentRoute);
        $this->assertSame([$brand], $target->parentParams);
    }

    public function test_general_device_problem_parents_through_the_device(): void
    {
        $device = new Device(['slug' => 'stiralnie-mashiny']);

        $problem = new Problem();
        $problem->setRelation('brands', new Collection());

        $target = $this->resolver->forProblem($problem, $device);

        $this->assertSame('devices.show', $target->parentRoute);
        $this->assertSame([$device], $target->parentParams);
    }

    public function test_brand_specific_error_code_parents_through_its_brand(): void
    {
        $device = new Device(['slug' => 'stiralnie-mashiny']);
        $brand = new Brand(['name' => 'Bosch', 'slug' => 'bosch']);

        $errorCode = new ErrorCode();
        $errorCode->setRelation('brand', $brand);

        $target = $this->resolver->forErrorCode($errorCode, $device);

        $this->assertSame('devices.brands.show', $target->parentRoute);
        $this->assertSame([$brand], $target->parentParams);
    }

    public function test_general_device_error_code_parents_through_the_device(): void
    {
        $device = new Device(['slug' => 'stiralnie-mashiny']);

        $errorCode = new ErrorCode();
        $errorCode->setRelation('brand', null);

        $target = $this->resolver->forErrorCode($errorCode, $device);

        $this->assertSame('devices.show', $target->parentRoute);
        $this->assertSame([$device], $target->parentParams);
    }

    public function test_gallery_with_brand_and_device_parents_through_device_with_brand_as_extra_crumb(): void
    {
        $device = new Device(['slug' => 'stiralnie-mashiny']);
        $brand = new Brand(['name' => 'Bosch', 'slug' => 'bosch']);

        $gallery = new Gallery();
        $gallery->setRelation('device', $device);
        $gallery->setRelation('brand', $brand);
        $gallery->setRelation('service', null);

        $target = $this->resolver->forGallery($gallery);

        $this->assertSame('devices.show', $target->parentRoute);
        $this->assertSame([$device], $target->parentParams);
        $this->assertSame('Bosch', $target->extraLabel);
        $this->assertSame('devices.brands.show', $target->extraRoute);
        $this->assertSame([$device, $brand], $target->extraParams);
    }

    public function test_gallery_with_service_but_no_brand_parents_through_device_with_service_as_extra_crumb(): void
    {
        $device = new Device(['slug' => 'stiralnie-mashiny']);
        $service = new Service(['name' => 'Замена насоса', 'slug' => 'zamena-nasosa']);
        $service->setRelation('device', $device);

        $gallery = new Gallery();
        $gallery->setRelation('device', null);
        $gallery->setRelation('brand', null);
        $gallery->setRelation('service', $service);

        $target = $this->resolver->forGallery($gallery);

        $this->assertSame('devices.show', $target->parentRoute);
        $this->assertSame([$device], $target->parentParams);
        $this->assertSame('Замена насоса', $target->extraLabel);
        $this->assertSame('services.show', $target->extraRoute);
        $this->assertSame([$device, 'zamena-nasosa'], $target->extraParams);
    }

    public function test_gallery_with_only_device_parents_through_device_without_extra_crumb(): void
    {
        $device = new Device(['slug' => 'stiralnie-mashiny']);

        $gallery = new Gallery();
        $gallery->setRelation('device', $device);
        $gallery->setRelation('brand', null);
        $gallery->setRelation('service', null);

        $target = $this->resolver->forGallery($gallery);

        $this->assertSame('devices.show', $target->parentRoute);
        $this->assertSame([$device], $target->parentParams);
        $this->assertNull($target->extraLabel);
    }

    public function test_gallery_with_no_context_falls_back_to_gallery_index(): void
    {
        $gallery = new Gallery();
        $gallery->setRelation('device', null);
        $gallery->setRelation('brand', null);
        $gallery->setRelation('service', null);

        $target = $this->resolver->forGallery($gallery);

        $this->assertSame('gallery.index', $target->parentRoute);
        $this->assertSame([], $target->parentParams);
        $this->assertNull($target->extraLabel);
    }

    public function test_gallery_prefers_brand_over_service_when_both_present(): void
    {
        $device = new Device(['slug' => 'stiralnie-mashiny']);
        $brand = new Brand(['name' => 'Bosch', 'slug' => 'bosch']);
        $service = new Service(['name' => 'Замена насоса', 'slug' => 'zamena-nasosa']);

        $gallery = new Gallery();
        $gallery->setRelation('device', $device);
        $gallery->setRelation('brand', $brand);
        $gallery->setRelation('service', $service);

        $target = $this->resolver->forGallery($gallery);

        $this->assertSame('devices.brands.show', $target->extraRoute);
    }
}
