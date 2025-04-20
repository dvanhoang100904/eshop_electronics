<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShippingAddress extends Model
{
    use HasFactory;

    // Định nghĩa khóa chính role_id của bảng shipping_addresses
    protected $primaryKey = "shipping_address_id";

    protected $fillable = [
        'name',
        'address',
        'phone',
        'user_id',
    ];

    /**
     * Quan hệ với bảng User.
     * Mỗi địa chỉ giao hàng thuộc về một người dùng.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
