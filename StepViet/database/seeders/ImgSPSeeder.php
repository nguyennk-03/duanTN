<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SanPham;
use App\Models\ImgSP;
use Faker\Factory as Faker;

class ImgSPSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Lấy danh sách sản phẩm
        $sanphams = SanPham::all();

        foreach ($sanphams as $sanpham) {
            // Tạo từ 1 đến 3 ảnh cho mỗi sản phẩm
            $numberOfImages = $faker->numberBetween(1, 3);
            for ($i = 0; $i < $numberOfImages; $i++) {
                ImgSP::create([
                    'MaSP' => $sanpham->MaSP, // Liên kết với sản phẩm
                    'DuongDan' => $faker->imageUrl(640, 480, 'fashion', true), // Đường dẫn ảnh giả
                ]);
            }
        }
    }
}

