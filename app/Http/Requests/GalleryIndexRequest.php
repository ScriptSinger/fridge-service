<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GalleryIndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'sort' => ['nullable', 'string', 'max:32'],
            'brand' => ['nullable', 'string', 'max:120'],
            'device' => ['nullable', 'string', 'max:120'],
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'sort' => strtolower(trim((string) $this->query('sort', 'newest'))),
            'brand' => strtolower(trim((string) $this->query('brand', 'all'))),
            'device' => strtolower(trim((string) $this->query('device', 'all'))),
        ]);
    }

    public function sort(): string
    {
        $sort = (string) $this->input('sort', 'newest');

        return in_array($sort, ['newest', 'oldest'], true) ? $sort : 'newest';
    }

    public function brand(): string
    {
        $brand = (string) $this->input('brand', 'all');

        return $brand !== '' ? $brand : 'all';
    }

    public function device(): string
    {
        $device = (string) $this->input('device', 'all');

        return $device !== '' ? $device : 'all';
    }
}

