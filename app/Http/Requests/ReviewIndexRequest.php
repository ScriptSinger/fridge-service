<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewIndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'sort' => ['nullable', 'string', 'max:32'],
            'source' => ['nullable', 'string', 'max:120'],
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'sort' => strtolower(trim((string) $this->query('sort', 'newest'))),
            'source' => strtolower(trim((string) $this->query('source', 'all'))),
        ]);
    }

    public function sort(): string
    {
        $sort = (string) $this->input('sort', 'newest');

        return in_array($sort, ['newest', 'oldest', 'positive', 'negative'], true) ? $sort : 'newest';
    }

    public function source(): string
    {
        $source = (string) $this->input('source', 'all');

        return $source !== '' ? $source : 'all';
    }
}

