<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    // Định nghĩa khóa chính payment_id của bảng payments
    protected $primaryKey = "payment_id";

    protected $fillable = [
        'method',
        'status',
        'order_id'
    ];

    /**
     * Ép kiểu dữ liệu cho các trường.
     */
    protected $casts = [
        'method' => 'string',
        'status' => 'string',
    ];

    /**
     * Quan hệ với model Order.
     * Một payment thuộc về một đơn hàng (order).
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }
}
