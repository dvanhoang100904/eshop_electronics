<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    // Định nghĩa khóa chính product_id của bảng products
    protected $primaryKey = 'product_id';

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'category_id',
        'slug',
        'is_featured',
        'sold',
    ];

    /**
     * Ép kiểu dữ liệu cho các trường.
     */
    protected $casts = [
        'is_featured' => 'boolean',
    ];

    /**
     * Tự động tạo slug khi chưa có.
     * Sử dụng tên sản phẩm và tạo một slug duy nhất cho mỗi sản phẩm.
     */
    protected static function booted()
    {
        static::creating(function ($product) {
            if (empty($product->slug)) {
                // Tạo slug ban đầu từ tên sản phẩm
                $slug = Str::slug($product->name);

                // Kiểm tra slug đã tồn tại chưa, nếu có thì thêm mã số ngẫu nhiên
                while (Product::where('slug', $slug)->exists()) {
                    $slug = Str::slug($product->name) . '-' . uniqid();
                }

                $product->slug = $slug;
            }
        });
    }

    /**
     * Quan hệ với bảng Category.
     * Một sản phẩm thuộc về một danh mục.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }
}
