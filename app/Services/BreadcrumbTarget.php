<?php

namespace App\Services;

final readonly class BreadcrumbTarget
{
    /**
     * @param array<int, mixed> $parentParams
     * @param array<int, mixed> $extraParams
     */
    public function __construct(
        public string $parentRoute,
        public array $parentParams = [],
        public ?string $extraLabel = null,
        public ?string $extraRoute = null,
        public array $extraParams = [],
    ) {
    }
}
