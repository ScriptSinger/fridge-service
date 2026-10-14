<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Initial order by brand popularity in Ufa per device type.
     * Brands not listed keep the default and go after these.
     */
    private const ORDER = [
        'remont-holodilnikov' => [
            'atlant', 'samsung', 'lg', 'bosch', 'indesit', 'haier', 'beko', 'liebherr', 'stinol',
            'biryusa', 'hotpoint-ariston', 'ariston', 'electrolux', 'siemens', 'candy', 'midea', 'miele', 'centek',
        ],
        'remont-stiralnyh-mashin' => [
            'lg', 'samsung', 'bosch', 'indesit', 'haier', 'beko', 'candy', 'atlant', 'hotpoint-ariston',
            'ariston', 'electrolux', 'siemens', 'miele', 'biryusa', 'centek',
        ],
    ];

    public function up(): void
    {
        Schema::table('brand_device', function (Blueprint $table) {
            $table->unsignedSmallInteger('sort_order')->default(500)->after('device_id');
        });

        foreach (self::ORDER as $deviceSlug => $brandSlugs) {
            $deviceId = DB::table('devices')->where('slug', $deviceSlug)->value('id');
            if (! $deviceId) {
                continue;
            }

            foreach ($brandSlugs as $position => $brandSlug) {
                DB::table('brand_device')
                    ->where('device_id', $deviceId)
                    ->whereIn('brand_id', DB::table('brands')->where('slug', $brandSlug)->select('id'))
                    ->update(['sort_order' => ($position + 1) * 10]);
            }
        }
    }

    public function down(): void
    {
        Schema::table('brand_device', function (Blueprint $table) {
            $table->dropColumn('sort_order');
        });
    }
};
