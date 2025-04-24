<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    // Định nghĩa khóa chính category_id của bảng categories
    protected $primaryKey = 'category_id';

    protected $fillable = [
        'name',
        'description',
        'image',
        'slug',
        'is_featured'
    ];

    /**
     * Kiểu dữ liệu được ép kiểu (cast).
     */
    protected $casts = [
        'is_featured' => 'boolean',
    ];

    /**
     * Sự kiện khởi tạo model.
     * Tự động tạo slug nếu chưa có khi tạo mới danh mục.
     */
    protected static function booted()
    {
        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name) . '-' . uniqid();
            }
        });
    }

    /**
     * Quan hệ với model Product.
     * Một danh mục có thể có nhiều sản phẩm.
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id', 'category_id');
    }
}
