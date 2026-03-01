<?php

namespace App\Models;

use App\Models\Concerns\HasImageUrl;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Certificate extends Model
{
    use HasImageUrl;

    protected $fillable = [
        'master_id',
        'title',
        'subtitle',
        'description',
        'image'
    ];

    public function master(): BelongsTo
    {
        return $this->belongsTo(Master::class);
    }
}
