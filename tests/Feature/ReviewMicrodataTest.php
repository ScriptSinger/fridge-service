<?php

namespace Tests\Feature;

use App\Models\Review;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Google rejects ApplianceRepair as itemReviewed, so review microdata uses the
 * type from config('contacts.schema_business_type') in every place it is output.
 */
class ReviewMicrodataTest extends TestCase
{
    use RefreshDatabase;

    public function test_reviews_page_marks_reviewed_business_with_configured_type(): void
    {
        Review::create([
            'name' => 'Анна',
            'title' => 'Анна',
            'text' => 'Всё хорошо',
            'rating' => 5,
            'is_published' => true,
            'published_at' => '2026-09-01',
        ]);

        $html = $this->get(route('reviews.index'))->assertOk()->getContent();

        $this->assertStringContainsString('itemprop="itemReviewed" itemscope itemtype="https://schema.org/LocalBusiness"', $html);
        $this->assertStringNotContainsString('itemprop="itemReviewed" itemscope itemtype="https://schema.org/ApplianceRepair"', $html);
    }

    public function test_review_type_follows_config(): void
    {
        config(['contacts.schema_business_type' => 'Organization']);

        Review::create([
            'name' => 'Анна',
            'title' => 'Анна',
            'text' => 'Всё хорошо',
            'rating' => 5,
            'is_published' => true,
            'published_at' => '2026-09-01',
        ]);

        $this->get(route('reviews.index'))
            ->assertSee('itemprop="itemReviewed" itemscope itemtype="https://schema.org/Organization"', false);
    }
}
