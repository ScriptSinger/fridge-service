<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * URLs renamed before the redirects table existed (2026-09-12) were never
 * recorded, so Yandex Webmaster still reports them as broken 404s.
 * /gallery/remont-stiralnoy-mashiny-lg is left out on purpose: it split into
 * two LG works and there is no single right target.
 */
return new class extends Migration
{
    private const REDIRECTS = [
        '/gallery/remont-holodilnika-beko-cn335220x' => '/gallery/remont-holodilnika-beko-cn335220x-ne-vklyuchaetsya',
        '/gallery/remont-holodilnika-haier-c2fe636cxjru' => '/gallery/remont-holodilnika-haier-c2fe636cxjru-migaet-i-ne-zapuskaetsya',
        '/gallery/remont-holodilnika-atlant-hm-4424-049-nd' => '/gallery/remont-holodilnika-atlant-hm-4424-049-nd-zamena-kompressora',
        '/gallery/remont-holodilnika-bosch-kgn39vl17r' => '/gallery/zamena-kompressora-holodilnika-bosch-kgn39vl17r',
        '/gallery/remont-holodilnika-bosch-ksu445204o' => '/gallery/remont-holodilnika-bosch-ksu445204o-ne-vklyuchaetsya',
        '/gallery/remont-holodilnika-indesit-sb185-027' => '/gallery/remont-holodilnika-indesit-sb185-027-zamena-kompressora',
        '/gallery/remont-holodilnika-samsung-rl44qeus' => '/gallery/remont-holodilnika-samsung-rl44qeus-zamena-kompressora-md4a1q-l1u2',
        '/gallery/remont-stiralnoy-mashiny-bosch-wfc2066oe' => '/gallery/remont-stiralnoy-mashiny-bosch-wfc2066oe-ne-greet-vodu',
        '/remont-holodilnikov/ariston' => '/remont-holodilnikov/hotpoint-ariston',
        '/remont-stiralnyh-mashin/stinol' => '/remont-stiralnyh-mashin',
    ];

    public function up(): void
    {
        $now = now();

        // insertOrIgnore: a redirect recorded since then by RecordsSlugRedirects wins.
        DB::table('redirects')->insertOrIgnore(
            collect(self::REDIRECTS)
                ->map(fn ($to, $from) => [
                    'from_path' => $from,
                    'to_path' => $to,
                    'created_at' => $now,
                    'updated_at' => $now,
                ])
                ->values()
                ->all()
        );
    }

    public function down(): void
    {
        DB::table('redirects')->whereIn('from_path', array_keys(self::REDIRECTS))->delete();
    }
};
