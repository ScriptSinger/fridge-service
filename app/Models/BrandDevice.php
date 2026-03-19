<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandDevice extends Model
{
    protected $table = 'brand_device';

    protected $fillable = [
        'brand_id',
        'device_id',
        'h1',
        'subtitle',
        'title',
        'description',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}
