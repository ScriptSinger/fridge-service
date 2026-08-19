<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->string('h1')->nullable()->after('name');
            $table->string('subtitle')->nullable()->after('h1');
            $table->string('seo_title')->nullable()->after('subtitle');
            $table->text('seo_description')->nullable()->after('seo_title');
            $table->longText('content')->nullable()->after('description');
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['h1', 'subtitle', 'seo_title', 'seo_description', 'content']);
        });
    }
};
