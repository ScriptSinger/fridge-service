<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('brand_price', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained()->cascadeOnDelete();
            $table->foreignId('price_id')->constrained()->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['brand_id', 'price_id']);
            $table->index(['price_id', 'brand_id']);
        });

        DB::table('prices')
            ->whereNotNull('brand_id')
            ->orderBy('id')
            ->chunkById(100, function ($prices): void {
                $rows = [];
                $now = now();

                foreach ($prices as $price) {
                    $rows[] = [
                        'brand_id' => $price->brand_id,
                        'price_id' => $price->id,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                }

                if ($rows !== []) {
                    DB::table('brand_price')->insertOrIgnore($rows);
                }
            });
    }

    public function down(): void
    {
        Schema::dropIfExists('brand_price');
    }
};
