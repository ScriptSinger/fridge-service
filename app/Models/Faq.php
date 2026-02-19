<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{

    protected $fillable = [
        'device_id',
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

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
