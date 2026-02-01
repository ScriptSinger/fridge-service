<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{

    protected $fillable = [
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
}
