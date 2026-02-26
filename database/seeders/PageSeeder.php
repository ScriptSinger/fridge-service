<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\PageType;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Database\Seeders\Concerns\InteractsWithMediaMap;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class PageSeeder extends Seeder
{
    use InteractsWithMediaMap;

    public function run(): void
    {
        $mappedPages = $this->mediaMap()['pages'] ?? [];
        $pages = config('catalog.pages', []);

        foreach ($pages as $pageData) {
            $pageType = PageType::where('key', $pageData['type'])->firstOrFail();

            // Генерируем slug из H1, если его нет
            $pageData['slug'] = SlugService::createSlug(Page::class, 'slug', $pageData['h1']);

            // Подтягиваем HTML контент, если указан файл
            if (empty($pageData['content']) && ! empty($pageData['content_file'])) {
                $pageData['content'] = $this->loadHtmlContent($pageData['content_file']);
            }
            unset($pageData['content_file']);

            $mapped = $mappedPages[$pageData['type']] ?? [];
            if (! empty($mapped['image'])) {
                $pageData['image'] = $mapped['image'];
            }
            if (! empty($mapped['image_alt'])) {
                $pageData['image_alt'] = $mapped['image_alt'];
            }

            $pageData['page_type_id'] = $pageType->id;
            unset($pageData['type']); // больше не нужно

            Page::updateOrCreate(
                ['page_type_id' => $pageType->id],
                $pageData
            );
        }
    }

    private function loadHtmlContent(string $filename): string
    {
        $path = resource_path("content/{$filename}");
        return File::exists($path) ? File::get($path) : '';
    }
}
