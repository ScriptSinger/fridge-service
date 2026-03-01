<?php

namespace App\Models;

use App\Models\Concerns\HasImageUrl;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Master extends Model
{
    use Sluggable, HasImageUrl;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    protected $fillable = [
        'name',
        'role',
        'photo',
        'description'
    ];



    public function certificates(): HasMany
    {
        return $this->hasMany(Certificate::class);
    }
}
