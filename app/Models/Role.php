<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory;

    // Định nghĩa khóa chính role_id của bảng roles
    protected $primaryKey = 'role_id';

    protected $fillable = [
        'name'
    ];

    /**
     * Quan hệ với bảng User.
     * Một vai trò có thể có nhiều người dùng 
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'role_id', 'role_id');
    }
}
