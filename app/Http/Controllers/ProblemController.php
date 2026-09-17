<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\Problem;
use Illuminate\Support\Facades\Cache;

class ProblemController extends Controller
{
    public function show(Device $device, string $problem)
    {
        $ttl = now()->addMinutes(20);

        $problem = Cache::remember(
            "problem:device:{$device->id}:{$problem}",
            $ttl,
            fn () => Problem::query()
                ->where('device_id', $device->id)
                ->where('slug', $problem)
                ->where('is_active', true)
                ->with([
                    'brands' => fn ($query) => $query->where('is_active', true),
                    'errorCodes.brand',
                    'errorCodes.device',
                    'services' => fn ($query) => $query->where('is_active', true),
                ])
                ->firstOrFail()
        );

        $galleries = Cache::remember(
            "gallery:problem:{$problem->id}",
            $ttl,
            fn () => Gallery::query()
                ->where('problem_id', $problem->id)
                ->orderBy('sort_order')
                ->get()
        );

        $faqs = Cache::remember(
            "faqs:problem:{$problem->id}",
            $ttl,
            fn () => Faq::query()
                ->where('problem_id', $problem->id)
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get()
        );

        return view('pages.problem', compact('device', 'problem', 'galleries', 'faqs'));
    }
}
