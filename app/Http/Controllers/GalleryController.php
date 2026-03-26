<?php

namespace App\Http\Controllers;

use App\Http\Requests\GalleryIndexRequest;
use App\Models\Gallery;
use App\Pipelines\GalleryPipeline;
use App\Services\GalleryFilterOptionsService;

class GalleryController extends Controller
{
    public function index(GalleryIndexRequest $request, GalleryFilterOptionsService $filterOptionsService)
    {
        $ttl = now()->addMinutes(20);
        $sort = $request->sort();
        $activeBrand = $request->brand();
        $activeDevice = $request->device();

        $brandOptions = $filterOptionsService->getBrandOptions($ttl);
        $deviceOptions = $filterOptionsService->getDeviceOptions($ttl);
        $activeBrand = $filterOptionsService->normalizeActiveOption($activeBrand, $brandOptions);
        $activeDevice = $filterOptionsService->normalizeActiveOption($activeDevice, $deviceOptions);

        $galleriesQuery = Gallery::query()
            ->with(['device', 'brand', 'service'])
            ->hasImage();

        $galleriesQuery = GalleryPipeline::apply($galleriesQuery, [
            'brand' => $activeBrand,
            'device' => $activeDevice,
            'sort' => $sort,
        ]);

        $galleries = $galleriesQuery
            ->paginate(24)
            ->withQueryString();

        return view('pages.gallery', [
            'galleries' => $galleries,
            'total' => $galleries->total(),
            'brandOptions' => ['all' => 'Все бренды'] + $brandOptions->all(),
            'deviceOptions' => ['all' => 'Вся техника'] + $deviceOptions->all(),
            'activeBrand' => $activeBrand,
            'activeDevice' => $activeDevice,
        ]);
    }

    public function show(Gallery $gallery)
    {
        $gallery->load(['device', 'brand', 'service']);

        $title = $gallery->title ?: 'Выполненный ремонт';
        $description = $gallery->subtitle ?: 'Фото выполненных работ по ремонту бытовой техники.';

        return view('pages.gallery-show', [
            'gallery' => $gallery,
            'title' => $title,
            'description' => $description,
        ]);
    }
}
