<?php

declare(strict_types=1);

namespace App\Support;

use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use SplFileObject;

/**
 * Counts events in the `auth` channel (storage/logs/auth-*.log), see
 * App\Listeners\LogAdminAuthEvent.
 */
class AuthLogReader
{
    public function __construct(private ?string $directory = null)
    {
    }

    /**
     * @param  int  $since  unix timestamp
     */
    public function failedLoginsSince(int $since): int
    {
        $dir = $this->directory ?? storage_path('logs');
        $count = 0;

        foreach (glob($dir . '/auth-*.log') ?: [] as $path) {
            if (filemtime($path) < $since) {
                continue;
            }

            $file = new SplFileObject($path, 'r');
            $file->setFlags(SplFileObject::DROP_NEW_LINE);

            foreach ($file as $line) {
                $entry = is_string($line) && $line !== '' ? json_decode($line, true) : null;

                if (! is_array($entry) || Arr::get($entry, 'message') !== 'login_failed') {
                    continue;
                }

                try {
                    $time = Carbon::parse((string) Arr::get($entry, 'datetime'))->getTimestamp();
                } catch (\Throwable) {
                    continue;
                }

                if ($time >= $since) {
                    $count++;
                }
            }
        }

        return $count;
    }
}
