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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->foreignId('device_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('slug')->unique()->nullable();
            $table->json('tags')->nullable();
            $table->timestamps();
            $table->boolean('is_active')->default(true);
            // индекс для быстрого поиска по device + brand
            $table->index(['device_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
