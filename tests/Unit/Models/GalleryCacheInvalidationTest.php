<?php

namespace Tests\Unit\Models;

use App\Models\Gallery;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

/**
 * Gallery::clearFrontendCache() picks which cache keys to forget based on
 * which relations are set (and, for renamed/re-linked records, on the
 * *previous* attribute values passed in). A wrong key or a loosened
 * device+brand condition would leave stale pages cached silently.
 */
class GalleryCacheInvalidationTest extends TestCase
{
    public function test_clears_all_related_cache_keys_when_relations_are_set(): void
    {
        Cache::put('gallery:problem:5', 'x', 60);
        Cache::put('gallery:error-code:7', 'x', 60);
        Cache::put('gallery:device:1:brand:2', 'x', 60);
        Cache::put('untouched', 'x', 60);

        $gallery = new Gallery([
            'problem_id' => 5,
            'error_code_id' => 7,
            'device_id' => 1,
            'brand_id' => 2,
        ]);

        $gallery->clearFrontendCache();

        $this->assertFalse(Cache::has('gallery:problem:5'));
        $this->assertFalse(Cache::has('gallery:error-code:7'));
        $this->assertFalse(Cache::has('gallery:device:1:brand:2'));
        $this->assertTrue(Cache::has('untouched'));
    }

    public function test_skips_device_brand_cache_key_when_brand_is_missing(): void
    {
        Cache::put('gallery:device:1:brand:2', 'x', 60);

        $gallery = new Gallery(['device_id' => 1]);

        $gallery->clearFrontendCache();

        $this->assertTrue(Cache::has('gallery:device:1:brand:2'));
    }

    public function test_skips_device_brand_cache_key_when_device_is_missing(): void
    {
        Cache::put('gallery:device:1:brand:2', 'x', 60);

        $gallery = new Gallery(['brand_id' => 2]);

        $gallery->clearFrontendCache();

        $this->assertTrue(Cache::has('gallery:device:1:brand:2'));
    }

    public function test_clears_cache_for_previous_attribute_values_when_record_was_relinked(): void
    {
        Cache::put('gallery:problem:99', 'x', 60);

        $gallery = new Gallery(['problem_id' => 5]);

        $gallery->clearFrontendCache([
            'problem_id' => 99,
            'error_code_id' => null,
            'device_id' => null,
            'brand_id' => null,
        ]);

        $this->assertFalse(Cache::has('gallery:problem:99'));
    }
}
