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

        // faker 10 danh mục và 10 thương hiệu
        $danhmucIds = \App\Models\DanhMuc::pluck('id')->toArray(); 
        $thuonghieuIds = \App\Models\ThuongHieu::pluck('id')->toArray(); 

        for ($i = 0; $i < 50; $i++) {
            $sanPham = SanPham::create([
                'tensp' => $faker->word(),
                'mota' => $faker->text(),
                'giaban' => $faker->randomFloat(2, 100, 1000),
                'giagiam' => $faker->randomFloat(2, 50, 900),
                'soluong' => $faker->numberBetween(1, 100),
                'danhmuc_id' => $faker->randomElement($danhmucIds), 
                'thuonghieu_id' => $faker->randomElement($thuonghieuIds), 
                'img' => $faker->imageUrl(),
            ]);
        }
    }
}
