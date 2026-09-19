<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->string('channel')->default('form')->after('leadable_id');
            $table->string('ip_address', 45)->nullable()->after('channel');
            $table->text('user_agent')->nullable()->after('ip_address');
        });

        // phone is required for a form submission but a contact-click row
        // (phone/whatsapp/telegram) only records intent — we never learn the
        // visitor's number.
        Schema::table('leads', function (Blueprint $table) {
            $table->string('phone')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('leads')->whereNull('phone')->update(['phone' => '']);

        Schema::table('leads', function (Blueprint $table) {
            $table->string('phone')->nullable(false)->change();
        });

        Schema::table('leads', function (Blueprint $table) {
            $table->dropColumn(['channel', 'ip_address', 'user_agent']);
        });
    }
};
