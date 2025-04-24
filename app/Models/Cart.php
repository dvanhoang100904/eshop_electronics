<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    use HasFactory;

    // Định nghĩa khóa chính cart_id của bảng carts
    protected $primaryKey = 'cart_id';

    protected $fillable = [
        'session_id',
        'user_id'
    ];


    /**
     * Quan hệ với model User.
     * Một giỏ hàng thuộc về một người dùng.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    /**
     * Quan hệ với model CartItem.
     * Một giỏ hàng có thể chứa nhiều sản phẩm (CartItem).
     */
    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class, 'cart_id', 'cart_id');
    }
}
