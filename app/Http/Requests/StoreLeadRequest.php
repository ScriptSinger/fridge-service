<?php

namespace App\Http\Requests;

use App\Models\Brand;
use App\Models\Device;
use App\Models\ErrorCode;
use App\Models\Page;
use App\Models\Problem;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLeadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'comment' => ['nullable', 'string'],

            // morph
            'leadable_type' => ['nullable', 'string', Rule::in($this->allowedLeadableTypes())],
            'leadable_id' => ['nullable', 'integer', 'required_with:leadable_type'],

            // UTM
            'utm_source' => ['nullable', 'string', 'max:255'],
            'utm_medium' => ['nullable', 'string', 'max:255'],
            'utm_campaign' => ['nullable', 'string', 'max:255'],
        ];
    }


    public function prepareForValidation()
    {
        // можно автоматом привести
        $this->merge([
            'phone' => trim($this->phone),
        ]);
    }

    public function allowedLeadableTypes(): array
    {
        return [
            Device::class,
            Brand::class,
            Problem::class,
            ErrorCode::class,
            Page::class,
        ];
    }
}
