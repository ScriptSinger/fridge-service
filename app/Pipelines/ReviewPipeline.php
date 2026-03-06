<?php

namespace App\Pipelines;

use App\Filters\Review\SortFilter;
use App\Filters\Review\SourceFilter;
use App\Filters\Review\WithPhotoFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pipeline\Pipeline;

class ReviewPipeline
{
    public static function apply(Builder $query, array $filters): Builder
    {
        $result = app(Pipeline::class)
            ->send([
                'query' => $query,
                'filters' => $filters,
            ])
            ->through([
                SourceFilter::class,
                WithPhotoFilter::class,
                SortFilter::class,
            ])
            ->thenReturn();

        return $result['query'];
    }
}
