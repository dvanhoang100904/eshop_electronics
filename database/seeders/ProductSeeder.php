<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $categoryIds = Category::pluck('category_id')->all();

        for ($i = 1; $i <= 50; $i++) {
            Product::create([
                'name' => $faker->sentence(3),
                'description' => $faker->paragraph(),
                'price' => $faker->randomFloat(2, 100, 5000),
                'image' => 'products/' . $faker->image(storage_path('app/public/products'), 400, 300, null, false),
                'category_id' => $faker->randomElement($categoryIds),
                'is_featured' => $faker->boolean(30),
            ]);
        }
    }
}
