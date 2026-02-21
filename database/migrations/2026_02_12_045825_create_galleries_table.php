<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();

            // Связи (используется только одно из полей)
            $table->foreignId('page_id')->nullable()
                ->constrained()->nullOnDelete();

            $table->foreignId('device_id')->nullable()
                ->constrained()->nullOnDelete();

            $table->foreignId('brand_id')->nullable()
                ->constrained()->nullOnDelete();

            $table->foreignId('service_id')->nullable()
                ->constrained()->nullOnDelete();

            // Контент
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->text('description')->nullable();

            // Изображение
            $table->string('image')->nullable();
            $table->string('image_alt');

            // Порядок
            $table->unsignedInteger('sort_order')->default(0);

            // Индексы для выборок
            $table->index('page_id');
            $table->index('device_id');
            $table->index('brand_id');
            $table->index('service_id');
            $table->index('sort_order');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};
