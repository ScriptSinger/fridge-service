<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Device;
use App\Models\ErrorCode;
use App\Models\Faq;
use App\Models\Page;
use App\Models\PageType;
use App\Models\Problem;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Problem and ErrorCode pages previously had no FAQ section at all. Now that
 * Faq can scope to problem_id/error_code_id, make sure each page shows only
 * its own FAQs and not another problem/error-code's.
 */
class FaqScopingTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_does_not_show_service_scoped_faqs(): void
    {
        $pageType = PageType::create([
            'key' => 'home',
            'name' => 'Главная',
            'template' => 'home',
            'is_system' => true,
        ]);

        Page::create([
            'page_type_id' => $pageType->id,
            'h1' => 'Главная',
            'subtitle' => 'Ремонт бытовой техники',
            'title' => 'Главная',
            'description' => 'Главная страница',
            'is_active' => true,
        ]);

        $device = Device::create([
            'slug' => 'stiralnie-mashiny',
            'permalink' => 'Стиральные машины',
            'type' => 'Стиральная машина',
            'is_active' => true,
        ]);

        $service = Service::create([
            'device_id' => $device->id,
            'name' => 'Замена насоса',
            'slug' => 'zamena-nasosa',
            'is_active' => true,
        ]);

        Faq::create([
            'question' => 'Общий вопрос для главной?',
            'answer' => 'Общий ответ.',
            'is_active' => true,
        ]);

        Faq::create([
            'service_id' => $service->id,
            'question' => 'Вопрос только для услуги?',
            'answer' => 'Ответ только для услуги.',
            'is_active' => true,
        ]);

        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertSee('Общий вопрос для главной?');
        $response->assertDontSee('Вопрос только для услуги?');
    }

    public function test_problem_page_shows_only_its_own_faqs(): void
    {
        $device = Device::create([
            'slug' => 'stiralnie-mashiny',
            'permalink' => 'Стиральные машины',
            'type' => 'Стиральная машина',
            'is_active' => true,
        ]);

        $problem = Problem::create([
            'device_id' => $device->id,
            'slug' => 'ne-slivaet-vodu',
            'title' => 'Не сливает воду',
            'h1' => 'Стиральная машина не сливает воду',
            'is_active' => true,
        ]);

        $otherProblem = Problem::create([
            'device_id' => $device->id,
            'slug' => 'ne-vklyuchaetsya',
            'title' => 'Не включается',
            'h1' => 'Стиральная машина не включается',
            'is_active' => true,
        ]);

        Faq::create([
            'problem_id' => $problem->id,
            'question' => 'Сколько стоит устранить засор насоса?',
            'answer' => 'От 1000 рублей.',
            'is_active' => true,
        ]);

        Faq::create([
            'problem_id' => $otherProblem->id,
            'question' => 'Почему машинка не включается вообще?',
            'answer' => 'Проверьте розетку.',
            'is_active' => true,
        ]);

        $response = $this->get(route('problems.show', [$device, $problem->slug]));

        $response->assertOk();
        $response->assertSee('Сколько стоит устранить засор насоса?');
        $response->assertDontSee('Почему машинка не включается вообще?');
    }

    public function test_error_code_page_shows_only_its_own_faqs(): void
    {
        $device = Device::create([
            'slug' => 'stiralnie-mashiny',
            'permalink' => 'Стиральные машины',
            'type' => 'Стиральная машина',
            'is_active' => true,
        ]);

        $brand = Brand::create([
            'name' => 'Bosch',
            'slug' => 'bosch',
            'is_active' => true,
        ]);

        $errorCode = ErrorCode::create([
            'device_id' => $device->id,
            'brand_id' => $brand->id,
            'code' => 'E15',
            'title' => 'Ошибка E15',
            'h1' => 'Ошибка E15',
            'slug' => 'e15',
            'is_active' => true,
        ]);

        $otherErrorCode = ErrorCode::create([
            'device_id' => $device->id,
            'brand_id' => $brand->id,
            'code' => 'E20',
            'title' => 'Ошибка E20',
            'h1' => 'Ошибка E20',
            'slug' => 'e20',
            'is_active' => true,
        ]);

        Faq::create([
            'error_code_id' => $errorCode->id,
            'question' => 'Что означает ошибка E15?',
            'answer' => 'Проблема со сливом.',
            'is_active' => true,
        ]);

        Faq::create([
            'error_code_id' => $otherErrorCode->id,
            'question' => 'Что означает ошибка E20?',
            'answer' => 'Проблема с нагревом.',
            'is_active' => true,
        ]);

        $response = $this->get(route('error-codes.show', [$device, $errorCode->slug]));

        $response->assertOk();
        $response->assertSee('Что означает ошибка E15?');
        $response->assertDontSee('Что означает ошибка E20?');
    }
}
