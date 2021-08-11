<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'media_id', 'url'];

    public function media(): BelongsTo
    {
        return $this->belongsTo(Media::class);
    }
}
