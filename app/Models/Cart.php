<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Cart extends Model
{
    use HasFactory;

    use HasFactory;
    protected $fillable = ['user_id', 'quantity',];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function product(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    public function cartProducts()
    {
        return $this->hasMany(CartProduct::class);
    }
}
