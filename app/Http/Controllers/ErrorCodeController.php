<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\ErrorCode;
use App\Models\Gallery;
use Illuminate\Support\Facades\Cache;

class ErrorCodeController extends Controller
{
    public function show(Device $device, string $errorCode)
    {
        $ttl = now()->addMinutes(20);

        $errorCode = Cache::remember(
            "error-code:device:{$device->id}:{$errorCode}",
            $ttl,
            fn () => ErrorCode::query()
                ->where('device_id', $device->id)
                ->where('slug', $errorCode)
                ->where('is_active', true)
                ->with([
                    'brand',
                    'problems' => fn ($query) => $query->where('is_active', true),
                ])
                ->firstOrFail()
        );

        $galleries = Cache::remember(
            "gallery:error-code:{$errorCode->id}",
            $ttl,
            fn () => Gallery::query()
                ->where('error_code_id', $errorCode->id)
                ->orderBy('sort_order')
                ->get()
        );

        return view('pages.error-code', compact('device', 'errorCode', 'galleries'));
    }
}
