<?php

namespace App\Http\Requests\Concerns;

use App\Models\Brand;
use App\Models\Device;
use App\Models\ErrorCode;
use App\Models\Page;
use App\Models\Problem;
use App\Models\Service;
use Illuminate\Validation\Rule;

/**
 * Shared by every FormRequest that lets a Lead attach to a polymorphic
 * "leadable" — keeps the class whitelist in one place, since it also guards
 * against arbitrary class instantiation when the controller later resolves
 * leadable_type::find($id).
 */
trait ValidatesLeadable
{
    public function allowedLeadableTypes(): array
    {
        return [
            Device::class,
            Brand::class,
            Problem::class,
            Service::class,
            ErrorCode::class,
            Page::class,
        ];
    }

    protected function leadableRules(): array
    {
        return [
            'leadable_type' => ['nullable', 'string', Rule::in($this->allowedLeadableTypes())],
            'leadable_id' => ['nullable', 'integer', 'required_with:leadable_type'],
        ];
    }
}
