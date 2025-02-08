<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SanPham;
use Faker\Factory as Faker;

class SanPhamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Giả sử bạn có 10 danh mục và 10 thương hiệu
        $danhmucIds = \App\Models\danhmuc::pluck('MaDM')->toArray();
        $thuonghieuIds = \App\Models\thuonghieu::pluck('MaTH')->toArray();

        for ($i = 0; $i < 50; $i++) {
            $sanPham = SanPham::create([
                'TenSP' => $faker->word(),
                'MoTa' => $faker->text(),
                'GiaBan' => $faker->randomFloat(2, 100, 1000),
                'GiaGiam' => $faker->randomFloat(2, 50, 900),
                'SoLuong' => $faker->numberBetween(1, 100),
                'MaDM' => rand(1, 5),
                'MaTH' => rand(1, 5),
                'IMG' => $faker->imageUrl(),  
            ]);
        }
    }
}
