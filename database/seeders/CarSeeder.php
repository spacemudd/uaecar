<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Car;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Car::create([
            'car_name' => 'AUDI Q8',
            'seats' => 3,
            'gear' => 'Automatic',
            'bags' => 2,
            'pictures' => 'front/img/blog/10.jpg',
            'car_picture' => 'front/img/blog/10.jpg',
        ]);

        Car::create([
            'car_name' => 'Bentley Bentayga',
            'seats' => 3,
            'gear' => 'Automatic',
            'bags' => 2,
            'pictures' => 'front/img/blog/11.jpg',
            'car_picture' => 'front/img/blog/11.jpg',
        ]);
    }
}
