<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Điện thoại, Tablet', 'description' => 'Các mẫu điện thoại thông minh', 'image' => 'phones.jpg', 'is_featured' => true],
            ['name' => 'Laptop', 'description' => 'Máy tính xách tay', 'image' => 'laptops.jpg', 'is_featured' => true],
            ['name' => 'Phụ kiện', 'description' => 'Phụ kiện công nghệ', 'image' => 'accessories.jpg', 'is_featured' => true],
            ['name' => 'Âm thanh', 'description' => 'Loa, tai nghe', 'image' => 'audio.jpg', 'is_featured' => true],
            ['name' => 'Màn hình', 'description' => 'Màn hình máy tính', 'image' => 'monitors.jpg', 'is_featured' => false],
        ];

        foreach ($categories as $data) {
            $data['slug'] = Str::slug($data['name']);
            Category::create($data);
        }
    }
}
