<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Support\Facades\Cache;

class PageController extends Controller
{
    public function showLegal(string $type)
    {
        $allowed = ['privacy-policy', 'personal-data-consent'];
        abort_unless(in_array($type, $allowed, true), 404);

        $ttl = now()->addMinutes(20);
        $page = Cache::remember("page:type:{$type}", $ttl, fn() => Page::where('type', $type)->firstOrFail());

        return view('pages.legal', [
            'page' => $page,
            'breadcrumbRoute' => "legal.{$type}",
        ]);
    }
}
