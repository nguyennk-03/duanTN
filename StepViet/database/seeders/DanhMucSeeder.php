<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\danhmuc;
use Faker\Factory as Faker;

class DanhMucSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker= Faker::create();
        for ($i = 0; $i < 10; $i++) {
            danhmuc::create([
                'tendm' => $faker->unique()->word(),
            ]);
        }
    }
}
