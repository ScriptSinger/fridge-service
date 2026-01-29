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
        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            // связь с услугой обязательная
            $table->foreignId('service_id')
                ->constrained()
                ->cascadeOnDelete();

            // связь с устройством и брендом опциональные
            $table->foreignId('device_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('brand_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            // диапазон цены
            $table->unsignedInteger('price_from')->nullable();
            $table->unsignedInteger('price_to')->nullable();

            // валюта/единица (по дефолту ₽)
            $table->string('units', 8)->default('₽');

            $table->timestamps();

            // индексы для fast lookup
            $table->index(['service_id', 'device_id', 'brand_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prices');
    }
};
