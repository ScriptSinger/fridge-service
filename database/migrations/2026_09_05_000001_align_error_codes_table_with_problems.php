<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('error_codes', function (Blueprint $table) {
            $table->string('slug')->unique()->nullable()->after('title');
            $table->string('h1')->nullable()->after('slug');
            $table->renameColumn('description', 'subtitle');
            $table->string('seo_title')->nullable()->after('code');
            $table->text('seo_description')->nullable()->after('seo_title');
            $table->longText('content')->nullable()->after('seo_description');
            $table->boolean('is_active')->default(true)->after('content');
        });

        // существующие записи ещё не имеют h1 — используем title как временную
        // заполненную заглушку, чтобы hero-заголовок страницы не был пустым
        DB::table('error_codes')->whereNull('h1')->update(['h1' => DB::raw('title')]);
    }

    public function down(): void
    {
        Schema::table('error_codes', function (Blueprint $table) {
            $table->dropColumn(['h1', 'seo_title', 'seo_description', 'content', 'is_active']);
            $table->renameColumn('subtitle', 'description');
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });
    }
};
