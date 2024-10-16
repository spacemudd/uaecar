<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Car;
class CarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Car::where('plate_number', 'A-52271')->update([
        //     'car_picture' => 'front/img/cars/HondaOdyssey2020_1.png'
        // ]);

        // Car::where('plate_number', 'B-48806')->update([
        //     'car_picture' => 'front/img/cars/nissansunny1.png'
        // ]);
        
        // Car::where('plate_number', 'B-69415')->update([
        //     'car_picture' => 'front/img/cars/Hyundai Sonata.png'
        // ]);

        // Car::where('plate_number', 'A-50943')->update([
        //     'car_picture' => 'front/img/cars/Santa_Fe_Hybrid.png'
        // ]);

        // Car::where('plate_number', 'A-52240')->update([
        //     'car_picture' => 'front/img/cars/mitsubishi_outlander_-small-15752.png'
        // ]);

        // Car::where('plate_number', 'A-52270')->update([
        //     'car_picture' => 'front/img/cars/bmw228i.png'
        // ]);

        // Car::where('plate_number', 'A-53169')->update([
        //     'car_picture' => 'front/img/cars/Hyundai Venue.png'
        // ]);

         // Delete rows with IDs from 20 to 30
         Car::where('id', [18, 17])->delete();
          
    
}
}