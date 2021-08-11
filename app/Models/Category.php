<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use PhpParser\Node\Expr\Cast\String_;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'media_id', 'category_id', 'description'];

    public function parentCategory(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function childCategory(): HasMany
    {
        return $this->hasMany(Category::class, 'category_id', 'id');
    }

    public function product(): HasMany
    {
        return $this->hasMany(Product::class, 'products', 'category_id');
    }

    public function media(): BelongsTo
    {
        return $this->belongsTo(Media::class);
    }


    // Accesser function

    public function getImageAttribute(): ?String
    {
        if ($this->media_id && $this->media) {
            return "/storage/" . $this->media->path;
        }
        return null;
    }
}
