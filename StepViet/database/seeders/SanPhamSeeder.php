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
                'IMG' => $faker->imageUrl(640, 480, 'fashion', true), 
                'MoTa' => $faker->sentence(),  
                'GiaBan' => $faker->randomFloat(2, 100, 1000), 
                'GiaGiam' => $faker->boolean() ? $faker->randomFloat(2, 50, 500) : null, 
                'SoLuong' => $faker->numberBetween(1, 100),  
                'danhmuc' => $faker->randomElement($danhmucIds),  
                'MaTH' => $faker->randomElement($thuonghieuIds),  
            ]);
        }
    }
}

