<?php

namespace App\Http\Requests;

use App\Http\Requests\Concerns\ValidatesLeadable;
use App\Models\Lead;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreContactClickRequest extends FormRequest
{
    use ValidatesLeadable;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'channel' => ['required', 'string', Rule::in([
                Lead::CHANNEL_PHONE,
                Lead::CHANNEL_WHATSAPP,
                Lead::CHANNEL_TELEGRAM,
                Lead::CHANNEL_VK,
            ])],

            // morph
            ...$this->leadableRules(),

            // UTM
            'utm_source' => ['nullable', 'string', 'max:255'],
            'utm_medium' => ['nullable', 'string', 'max:255'],
            'utm_campaign' => ['nullable', 'string', 'max:255'],
        ];
    }
}
