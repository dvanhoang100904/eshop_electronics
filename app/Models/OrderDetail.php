<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderDetail extends Model
{
    use HasFactory;

    // Định nghĩa khóa chính order_detail_id của bảng order_details
    protected $primaryKey = 'order_detail_id';

    protected $fillable = [
        'quantity',
        'price',
        'total_price',
        'order_id',
        'product_id'
    ];

    /**
     * Ép kiểu dữ liệu cho các trường.
     */
    protected $casts = [
        'total_price' => 'decimal:2',
        'quantity' => 'integer',
    ];

    /**
     * Quan hệ với model Order.
     * Một chi tiết đơn hàng thuộc về một đơn hàng.
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }

    /**
     * Quan hệ với model Product.
     * Một chi tiết đơn hàng thuộc về một sản phẩm.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
