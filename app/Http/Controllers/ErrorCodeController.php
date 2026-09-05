<?php

namespace App\Http\Controllers;

use App\Models\ErrorCode;
use App\Models\Gallery;
use Illuminate\Support\Facades\Cache;

class ErrorCodeController extends Controller
{
    public function show(ErrorCode $errorCode)
    {
        abort_unless($errorCode->is_active, 404);

        $errorCode->load([
            'brand',
            'problems' => fn ($query) => $query->where('is_active', true)->with('device.brands:id'),
        ]);

        $devices = $errorCode->problems
            ->pluck('device')
            ->filter()
            ->unique('id')
            ->filter(fn ($device) => $errorCode->brand && $device->brands->contains('id', $errorCode->brand->id))
            ->values();

        $galleries = Cache::remember(
            "gallery:error-code:{$errorCode->id}",
            now()->addMinutes(20),
            fn () => Gallery::query()
                ->where('error_code_id', $errorCode->id)
                ->orderBy('sort_order')
                ->get()
        );

        return view('pages.error-code', [
            'errorCode' => $errorCode,
            'devices' => $devices,
            'galleries' => $galleries,
        ]);
    }
}
