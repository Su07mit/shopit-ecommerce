<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Media extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'path', 'type'];

    public function product(): HasMany
    {
        return $this->hasMany(Product::class, 'products', 'media_id');
    }
}
