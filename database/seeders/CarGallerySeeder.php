<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarGallerySeeder extends Seeder
{
    public function run()
    {
        // Sample data to seed
        $galleries = [
            ['car_id' => 1, 'image_path' => 'front/img/cars/01.jpg'],
            ['car_id' => 1, 'image_path' => 'images/cars/02.jpg'],
            ['car_id' => 3, 'image_path' => 'images/cars/05.jpg'],
            ['car_id' => 2, 'image_path' => 'images/cars/03.jpg'],
            ['car_id' => 2, 'image_path' => 'images/cars/04_2.jpg'],
            ['car_id' => 3, 'image_path' => 'images/cars/05.jpg'],
            ['car_id' => 3, 'image_path' => 'images/cars/05.jpg'],

            // Add more entries as needed
        ];

        DB::table('car_gallery')->insert($galleries);
    }
}
