<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    use HasFactory;

    // Định nghĩa khóa chính cart_item_id của bảng cart_items
    protected $primaryKey = 'cart_item_id';

    protected $fillable = [
        'quantity',
        'cart_id',
        'product_id'
    ];

    /**
     * Quan hệ với bảng Cart.
     * Một CartItem thuộc về một giỏ hàng.
     */
    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class, 'cart_id', 'cart_id');
    }

    /**
     * Quan hệ với bảng Product.
     * Một CartItem thuộc về một sản phẩm.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
