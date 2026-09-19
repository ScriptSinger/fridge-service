<?php

namespace App\Http\Requests;

use App\Http\Requests\Concerns\ValidatesLeadable;
use App\Models\Lead;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class StoreLeadRequest extends FormRequest
{
    use ValidatesLeadable;

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
            'phone' => ['required', 'string', 'max:30', 'regex:/^[0-9\\s\\-\\+\\(\\)]+$/'],
            'comment' => ['nullable', 'string'],
            'intent' => ['nullable', 'string', Rule::in(Lead::INTENTS)],
            'privacy_policy' => ['accepted'],

            // morph
            ...$this->leadableRules(),

            // UTM
            'utm_source' => ['nullable', 'string', 'max:255'],
            'utm_medium' => ['nullable', 'string', 'max:255'],
            'utm_campaign' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'phone.required' => 'Поле "Телефон" обязательно для заполнения.',
            'phone.regex' => 'Телефон может содержать только цифры, пробелы, скобки, плюс и дефис.',
            'privacy_policy.accepted' => 'Необходимо согласиться с политикой конфиденциальности.',
        ];
    }


    public function prepareForValidation()
    {
        $this->merge([
            'phone' => trim($this->phone),
        ]);
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            $rawPhone = (string) $this->input('phone', '');
            $digits = preg_replace('/\\D+/', '', $rawPhone ?? '');

            if ($digits !== '' && (strlen($digits) < 10 || strlen($digits) > 15)) {
                $validator->errors()->add('phone', 'Phone number must contain 10 to 15 digits.');
            }
        });
    }
}
