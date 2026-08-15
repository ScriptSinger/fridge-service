<?php

namespace Tests\Feature;

use App\Models\Page;
use App\Models\PageType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $this->withoutVite();

        $pageType = PageType::create([
            'key' => 'home',
            'name' => 'Главная',
            'template' => 'home',
            'is_system' => true,
        ]);

        Page::create([
            'page_type_id' => $pageType->id,
            'h1' => 'Ремонт бытовой техники',
            'subtitle' => 'Тестовый подзаголовок.',
            'title' => 'Ремонт бытовой техники',
            'description' => 'Тестовая главная страница.',
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
