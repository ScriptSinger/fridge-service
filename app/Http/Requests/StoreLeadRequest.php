<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'leadable_type' => ['nullable', 'string'],
            'leadable_id' => ['nullable', 'integer'],

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
}
