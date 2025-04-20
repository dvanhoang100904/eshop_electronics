<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    // Định nghĩa khóa chính order_id của bảng orders
    protected $primaryKey = 'order_id';

    protected $fillable = [
        'total_price',
        'status',
        'notes',
        'user_id',
        'shipping_address_id',
    ];

    /**
     * Ép kiểu dữ liệu cho các trường.
     */
    protected $casts = [
        'total_price' => 'decimal:2',
        'status' => 'string',
    ];

    /**
     * Quan hệ với model User.
     * Một đơn hàng thuộc về một người dùng.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    /**
     * Quan hệ với model ShippingAddress.
     * Một đơn hàng có một địa chỉ giao hàng.
     */
    public function shippingAddress(): BelongsTo
    {
        return $this->belongsTo(ShippingAddress::class, 'shipping_address_id', 'shipping_address_id');
    }


    /**
     * Quan hệ với model OrderDetail.
     * Một đơn hàng có nhiều chi tiết sản phẩm.
     */
    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'order_id');
    }

    /**
     * Quan hệ với model Payment.
     * Một đơn hàng có một bản ghi thanh toán.
     */
    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class, 'order_id', 'order_id');
    }
}
