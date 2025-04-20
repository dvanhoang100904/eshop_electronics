<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $categories = Category::all();

        $categoryProducts = [
            'Điện thoại' => ['iPhone 13', 'Samsung Galaxy S21', 'Xiaomi Mi 11'],
            'Laptop' => ['MacBook Air M2', 'Dell XPS 13', 'HP Spectre x360'],
            'Máy tính bảng' => ['iPad Pro', 'Samsung Galaxy Tab', 'Lenovo Tab P11'],
            'Phụ kiện' => ['Cáp sạc nhanh', 'Bộ sạc dự phòng', 'Chuột không dây'],
            'Tai nghe' => ['AirPods Pro', 'Sony WH-1000XM4', 'JBL Tune 500'],
            'Camera' => ['Canon EOS M50', 'Sony A6400', 'Nikon Z50'],
            'Tivi' => ['Samsung QLED 4K', 'LG OLED CX', 'Sony Bravia 55"'],
            'Đồng hồ thông minh' => ['Apple Watch Series 8', 'Samsung Galaxy Watch', 'Huawei Watch GT3'],
            'Máy chơi game' => ['PS5', 'Xbox Series X', 'Nintendo Switch'],
            'Loa Bluetooth' => ['JBL Flip 5', 'Sony SRS-XB43', 'Anker Soundcore'],
        ];

        foreach ($categories as $category) {
            $productNames = $categoryProducts[$category->name] ?? ['Sản phẩm mặc định'];
            $imageNames = [
                'Điện thoại' => 'iphone.jpg',
                'Laptop' => 'macbook.jpg',
                'Tai nghe' => 'headphone.jpg',
                'Camera' => 'camera.jpg',
                'Máy tính bảng' => 'tablet.jpg',
                'Đồng hồ thông minh' => 'watch.jpg',
                'Máy chơi game' => 'game.jpg',
                'Loa Bluetooth' => 'speaker.jpg',
                'Tivi' => 'tv.jpg',
                'Phụ kiện' => 'accessories.jpg',
            ];

            for ($i = 0; $i < 5; $i++) {
                $name = $faker->randomElement($productNames) . ' ' . strtoupper(Str::random(2));
                Product::create([
                    'name' => $name,
                    'description' => $faker->sentence(20),
                    'price' => $faker->numberBetween(100, 5000) * 1000,
                    'image' => 'products/' . ($imageNames[$category->name] ?? 'default.jpg'),
                    'category_id' => $category->category_id,
                    'is_featured' => $faker->boolean(30),
                    'slug' => Str::slug($name) . '-' . uniqid(),
                ]);
            }
        }
    }
}
