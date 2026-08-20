<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{

    protected $fillable = [
        'device_id',
        'service_id',
        'brand_id',
        'page_id',
        'question',
        'answer',
        'sort_order',
        'is_active',
    ];

    // Если нужно, можно добавить связь к типу техники
    public function device()
    {
        return $this->belongsTo(Device::class); // nullable для общих FAQ
    }

    public function service()
    {
        return $this->belongsTo(Service::class); // nullable, для FAQ конкретной услуги
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    /**
     * FAQPage JSON-LD для набора вопросов. Собирается в PHP, а не в blade-шаблоне,
     * т.к. Blade-компилятор путает '@type'/'@context' внутри @php-блока с директивами.
     */
    public static function jsonLdFor(iterable $faqs): string
    {
        $jsonLd = [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => collect($faqs)->map(fn (self $faq) => [
                '@type' => 'Question',
                'name' => $faq->question,
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => strip_tags($faq->answer),
                ],
            ])->values()->all(),
        ];

        return json_encode($jsonLd, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}
