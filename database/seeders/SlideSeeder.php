<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Slide;

class SlideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Slide::create([
            'image' => 'slides/slide1.jpg',
            'title' => 'Sản phẩm công nghệ mới',
            'description' => 'Khám phá những sản phẩm công nghệ mới với mức giá hấp dẫn.',
            'link' => 'http://127.0.0.1:8000/',
        ]);

        Slide::create([
            'image' => 'slides/slide2.jpg',
            'title' => 'Giảm giá 50%',
            'description' => 'Nhanh tay mua sắm các sản phẩm giảm giá lên đến 50%.',
            'link' => 'http://127.0.0.1:8000/',
        ]);

        Slide::create([
            'image' => 'slides/slide3.jpg',
            'title' => 'Phụ kiện chính hãng',
            'description' => 'Mua phụ kiện chính hãng với bảo hành dài hạn.',
            'link' => 'http://127.0.0.1:8000/',
        ]);
    }
}
