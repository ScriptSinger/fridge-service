<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Faq extends Model
{

    protected static function booted(): void
    {
        static::saved(function (Faq $faq): void {
            $faq->clearFrontendCache();
            $faq->clearFrontendCache($faq->getOriginal());
        });

        static::deleted(function (Faq $faq): void {
            $faq->clearFrontendCache();
        });
    }

    protected $fillable = [
        'device_id',
        'service_id',
        'problem_id',
        'error_code_id',
        'brand_id',
        'page_id',
        'question',
        'answer',
        'sort_order',
        'is_active',
    ];

    /**
     * Сбрасывает кэш всех страниц, на которых может отображаться FAQ.
     * Принимает прежние атрибуты, чтобы кэш очищался и после перепривязки FAQ.
     */
    public function clearFrontendCache(?array $attributes = null): void
    {
        $attributes ??= $this->getAttributes();

        foreach (Page::query()->pluck('id') as $pageId) {
            Cache::forget("faqs:page:{$pageId}");
        }

        $cacheKeys = [
            'device_id' => 'faqs:device:%s',
            'service_id' => 'faqs:device:%s:service:%s',
            'problem_id' => 'faqs:problem:%s',
            'error_code_id' => 'faqs:error-code:%s',
        ];

        if ($deviceId = $attributes['device_id'] ?? null) {
            Cache::forget(sprintf($cacheKeys['device_id'], $deviceId));
        }

        if (($serviceId = $attributes['service_id'] ?? null) && ($deviceId = $attributes['device_id'] ?? null)) {
            Cache::forget(sprintf($cacheKeys['service_id'], $deviceId, $serviceId));
        }

        if ($problemId = $attributes['problem_id'] ?? null) {
            Cache::forget(sprintf($cacheKeys['problem_id'], $problemId));
        }

        if ($errorCodeId = $attributes['error_code_id'] ?? null) {
            Cache::forget(sprintf($cacheKeys['error_code_id'], $errorCodeId));
        }
    }

    // Если нужно, можно добавить связь к типу техники
    public function device()
    {
        return $this->belongsTo(Device::class); // nullable для общих FAQ
    }

    public function service()
    {
        return $this->belongsTo(Service::class); // nullable, для FAQ конкретной услуги
    }

    public function problem()
    {
        return $this->belongsTo(Problem::class); // nullable, для FAQ конкретной неисправности
    }

    public function errorCode()
    {
        return $this->belongsTo(ErrorCode::class); // nullable, для FAQ конкретного кода ошибки
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
