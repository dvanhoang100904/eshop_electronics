<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'role_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed'
    ];


    /**
     * Quan hệ với bảng Role.
     * Mỗi người dùng có một vai trò và thuộc về một Role nhất định.
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id', 'role_id');
    }

    /**
     * Quan hệ với bảng Order.
     * Mỗi người dùng có thể có nhiều đơn hàng.
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'user_id', 'user_id');
    }

    /**
     * Quan hệ với bảng ShippingAddress.
     * Mỗi người dùng có thể có nhiều địa chỉ giao hàng .
     */
    public function shippingAddresses(): HasMany
    {
        return $this->hasMany(ShippingAddress::class, 'user_id', 'user_id');
    }

    /**
     * Quan hệ với bảng Cart.
     * Mỗi người dùng có một giỏ hàng (Cart).
     */
    public function cart(): HasOne
    {
        return $this->hasOne(Cart::class, 'user_id', 'user_id');
    }


    /**
     * Quan hệ với bảng CartItem thông qua Cart.
     * Mỗi người dùng có thể có nhiều item trong giỏ hàng thông qua Cart.
     */
    public function cartItems(): HasManyThrough
    {
        return $this->hasManyThrough(CartItem::class, Cart::class, 'user_id', 'cart_id', 'user_id', 'cart_id');
    }
}
