<?php

namespace Database\Seeders;

use App\Models\PageType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pageTypes = config('catalog.page_types', []);

        foreach ($pageTypes as $type) {
            PageType::updateOrCreate(['key' => $type['key']], $type);
        }
    }
}
