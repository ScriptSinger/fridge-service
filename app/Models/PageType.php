<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PageType extends Model
{

    protected $fillable = [
        'key',
        'name',
        'template',
        'is_system',
    ];

    public function page(): HasOne
    {
        return $this->hasOne(Page::class);
    }
}
