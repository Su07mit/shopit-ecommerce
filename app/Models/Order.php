<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    // const STATUS = ['Pending', 'Confirmed', 'Cancelled', 'Delivering', 'Completed', 'Return', 'Refund'];

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // public function product(): HasMany
    // {
    //     return $this->hasMany(Product::class);
    // }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
            ->withPivot(['id', 'quantity', 'unit_price']);
    }

    // Another Way For Pivot 
    // public function orderproduct(): HasMany
    // {
    //     return $this->hasMany(OrderProduct::class);
    // }

    public function coupon(): BelongsTo
    {
        return $this->belongsTo(Coupon::class);
    }

    public function getTotalAttribute()
    {
        $total = 0;

        foreach ($this->products as $item) {
            $total = $total + ($item->pivot->unit_price * $item->pivot->quantity);
        }

        return $total;
    }
}
