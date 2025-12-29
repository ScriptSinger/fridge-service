<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'comment',
        'utm_source',
        'utm_medium',
        'utm_campaign',
    ];

    public function leadable()
    {
        return $this->morphTo();
    }
}
