<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\thuonghieu;
use Faker\Factory as Faker;

class ThuongHieuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker= Faker::create();
        for ($i = 0; $i < 10; $i++) {
            thuonghieu::create([
                'tenth' => $faker->unique()->word(),
            ]);
        }
    }
}
