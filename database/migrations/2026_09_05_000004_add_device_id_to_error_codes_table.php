<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('error_codes', function (Blueprint $table) {
            // nullable: существующие записи не привязаны ни к какому устройству,
            // и разные коды относятся к разной технике — угадать нельзя,
            // проставить нужно вручную через админку. Обязательность для новых
            // записей обеспечивается на уровне формы MoonShine (->required())
            $table->foreignId('device_id')->nullable()->after('brand_id')
                ->constrained()->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('error_codes', function (Blueprint $table) {
            $table->dropConstrainedForeignId('device_id');
        });
    }
};
