<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $categories = [
            [
                'name' => 'Điện thoại',
                'image' => 'categories/phone.jpg'
            ],
            [
                'name' => 'Laptop',
                'image' => 'categories/laptop.jpg'
            ],
            [
                'name' => 'Máy tính bảng',
                'image'     => 'categories/tablet.jpg'
            ],
            [
                'name' => 'Phụ kiện',
                'image' => 'categories/accessories.jpg'
            ],
            [
                'name' => 'Tai nghe',
                'image' => 'categories/headphones.jpg'
            ],
            [
                'name' => 'Camera',
                'image' => 'categories/camera.jpg'
            ],
            [
                'name' => 'Tivi',
                'image' => 'categories/tv.jpg'
            ],
            [
                'name' => 'Đồng hồ thông minh',
                'image' => 'categories/smartwatch.jpg'
            ],
            [
                'name' => 'Máy chơi game',
                'image' => 'categories/game-console.jpg'
            ],
            [
                'name' => 'Loa Bluetooth',
                'image' => 'categories/speaker.jpg'
            ],
        ];

        foreach ($categories as $item) {
            Category::create([
                'name' => $item['name'],
                'slug' => Str::slug($item['name']),
                'description' => $faker->sentence(15),
                'is_featured' => $faker->boolean(30),
                'image' => 'storage/categories' . $item['image'],
            ]);
        }
    }
}
