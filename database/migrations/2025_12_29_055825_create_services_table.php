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
            $table->string('slug')->unique()->nullable();           // SEO-friendly URL
            $table->string('title');
            $table->string('type')->nullable();                       // <title>
            $table->string('description')->nullable();  // meta description
            $table->string('h1');                       // заголовок страницы
            $table->string('excerpt')->nullable();      // подзаголовок / Hero / preview
            $table->string('image')->nullable();        // hero / og:image
            $table->string('image_alt')->nullable();    // SEO alt для изображения
            $table->longText('content')->nullable();    // основной текст
            $table->boolean('is_active')->default(true); // управление показом
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('brand_service', function (Blueprint $table) {
            $table->dropForeign(['service_id']);
        });

        Schema::dropIfExists('services');
    }
};
