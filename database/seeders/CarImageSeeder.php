<?php

namespace Database\Seeders;
use App\Models\Car;
use App\Models\CarImage;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cars = Car::all();

        foreach ($cars as $car) {
            // Generate random images for each car
            CarImage::create([
                'car_id' => $car->id,
                'image_url' => '/front/img/cars/' . $car->id . '01.jpg', // Replace with your image URLs
            ]);
            CarImage::create([
                'car_id' => $car->id,
                'image_url' => '/front/img/cars/' . $car->id . '02.jpg',
            ]);
            CarImage::create([
                'car_id' => $car->id,
                'image_url' => '/front/img/cars/' . $car->id . '03.jpg',
            ]);
        }
    }
}
