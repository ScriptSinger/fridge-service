<?php

namespace App\Http\Controllers;

use App\Models\PageType;
use Illuminate\Support\Facades\Cache;

class PageController extends Controller
{
    public function showLegal(string $type)
    {
        $allowed = ['privacy-policy', 'personal-data-consent'];
        abort_unless(in_array($type, $allowed, true), 404);

        $ttl = now()->addMinutes(20);


        $page = Cache::remember("page:type:{$type}", $ttl, function () use ($type) {
            $pageType = PageType::with('page')
                ->where('key', $type)
                ->firstOrFail();

            return $pageType->page ?? abort(404);
        });


        return view('pages.legal', [
            'page' => $page,
            'breadcrumbRoute' => "legal.{$type}",
        ]);
    }
}
