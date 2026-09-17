<?php

namespace Tests\Feature\Models;

use App\Models\Review;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReviewScopesTest extends TestCase
{
    use RefreshDatabase;

    private function makeReview(array $attributes = []): Review
    {
        return Review::create(array_merge([
            'name' => 'Иван',
            'text' => 'Отличный сервис',
            'is_published' => true,
            'published_at' => now()->subDay(),
        ], $attributes));
    }

    public function test_published_scope_excludes_drafts_and_future_or_missing_publish_dates(): void
    {
        $published = $this->makeReview();
        $this->makeReview(['is_published' => false]);
        $this->makeReview(['is_published' => true, 'published_at' => now()->addDay()]);
        $this->makeReview(['is_published' => true, 'published_at' => null]);

        $ids = Review::published()->pluck('id');

        $this->assertSame([$published->id], $ids->all());
    }

    public function test_featured_scope_only_returns_featured_reviews(): void
    {
        $featured = $this->makeReview(['is_featured' => true]);
        $this->makeReview(['is_featured' => false]);

        $ids = Review::featured()->pluck('id');

        $this->assertSame([$featured->id], $ids->all());
    }

    public function test_has_source_scope_excludes_empty_source(): void
    {
        $withSource = $this->makeReview(['source' => 'yandex']);
        $this->makeReview(['source' => '']);

        $ids = Review::hasSource()->pluck('id');

        $this->assertSame([$withSource->id], $ids->all());
    }

    public function test_for_source_scope_matches_case_insensitively_and_all_bypasses_filter(): void
    {
        $yandex = $this->makeReview(['source' => 'Yandex']);
        $google = $this->makeReview(['source' => 'google']);

        $this->assertSame([$yandex->id], Review::forSource('yandex')->pluck('id')->all());
        $this->assertEqualsCanonicalizing(
            [$yandex->id, $google->id],
            Review::forSource('all')->pluck('id')->all(),
        );
    }

    public function test_has_image_scope_excludes_null_and_empty_image(): void
    {
        $withImage = $this->makeReview(['image' => 'reviews/photo.jpg']);
        $this->makeReview(['image' => null]);
        $this->makeReview(['image' => '']);

        $ids = Review::hasImage()->pluck('id');

        $this->assertSame([$withImage->id], $ids->all());
    }
}
