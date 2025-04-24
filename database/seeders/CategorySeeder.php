<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Điện thoại, Tablet', 'description' => 'Các mẫu điện thoại thông minh', 'image' => 'phones.jpg'],
            ['name' => 'Laptop',     'description' => 'Máy tính xách tay',       'image' => 'laptops.jpg'],
            ['name' => 'Phụ kiện',   'description' => 'Phụ kiện công nghệ',      'image' => 'accessories.jpg'],
            ['name' => 'Âm thanh',   'description' => 'Loa, tai nghe',           'image' => 'audio.jpg'],
            ['name' => 'Màn hình',   'description' => 'Màn hình máy tính',       'image' => 'monitors.jpg'],
        ];
        foreach ($categories as $data) {
            Category::create($data);
        }
    }
}
