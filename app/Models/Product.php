<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'price', 'on_sale', 'sale_price', 'description', 'media_id', 'category_id'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function media(): BelongsTo
    {
        return $this->belongsTo(Media::class);
    }

    // public function order(): HasMany
    // {
    //     return $this->hasMany(Order::class);
    // }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class);
    }

    public function stocks(): HasMany
    {
        return $this->hasMany(Stock::class);
    }


    public function getImageAttribute(): ?String
    {
        if ($this->media_id && $this->media) {
            return "/storage/" . $this->media->path;
        }

        return null;
    }
}
