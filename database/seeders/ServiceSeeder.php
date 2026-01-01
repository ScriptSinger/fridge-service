<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::firstOrCreate(
            ['title' => 'Ремонт холодильников'],
            [
                'h1' => 'Ремонт холодильников на дому',
                'content' => '...',
                'is_active' => true,
            ]
        );
    }
}
