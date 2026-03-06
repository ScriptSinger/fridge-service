<?php

namespace App\Pipelines;

use App\Filters\Gallery\BrandFilter;
use App\Filters\Gallery\DeviceFilter;
use App\Filters\Gallery\SortFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pipeline\Pipeline;

class GalleryPipeline
{
    public static function apply(Builder $query, array $filters): Builder
    {
        $result = app(Pipeline::class)
            ->send([
                'query' => $query,
                'filters' => $filters,
            ])
            ->through([
                BrandFilter::class,
                DeviceFilter::class,
                SortFilter::class,
            ])
            ->thenReturn();

        return $result['query'];
    }
}

