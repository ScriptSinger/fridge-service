<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Master extends Model
{
    use Sluggable;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['last_name', 'first_name', 'middle_name'],
            ],
        ];
    }

    protected $fillable = [
        'last_name',
        'first_name',
        'middle_name',
        'role',
        'photo',
        'description'
    ];

    public function certificates(): HasMany
    {
        return $this->hasMany(Certificate::class);
    }

    public function getNameAttribute(): string
    {
        return trim(implode(' ', array_filter([
            $this->last_name,
            $this->first_name,
            $this->middle_name,
        ])));
    }

    public function getFullNameAttribute(): string
    {
        return $this->name;
    }

    public function getPhotoUrlAttribute(): ?string
    {
        $photo = (string) ($this->photo ?? '');

        if ($photo === '') {
            return null;
        }

        if (Str::startsWith($photo, ['http://', 'https://'])) {
            return $photo;
        }

        return Storage::disk(config('filesystems.media'))->url($photo);
    }
}
