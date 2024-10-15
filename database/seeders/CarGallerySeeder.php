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
            ['car_id' => 75, 'image_path' => 'front/img/cars/01.jpg'],
            ['car_id' => 75, 'image_path' => 'front/img/cars/02.jpg'],
            ['car_id' => 75, 'image_path' => 'front/img/cars/05.jpg'],
            ['car_id' => 76, 'image_path' => 'front/img/cars/03.jpg'],
            ['car_id' => 76, 'image_path' => 'front/img/cars/02.jpg'],
            ['car_id' => 76, 'image_path' => 'front/img/cars/05.jpg'],
            ['car_id' => 77, 'image_path' => 'front/img/cars/06.jpg'],
            ['car_id' => 77, 'image_path' => 'front/img/cars/01.jpg'],
            ['car_id' => 77, 'image_path' => 'front/img/cars/02.jpg'],
            ['car_id' => 78, 'image_path' => 'front/img/cars/03.jpg'],
            ['car_id' => 78, 'image_path' => 'front/img/cars/04.jpg'],
            ['car_id' => 78, 'image_path' => 'front/img/cars/05.jpg'],
            ['car_id' => 79, 'image_path' => 'front/img/cars/06.jpg'],
            ['car_id' => 79, 'image_path' => 'front/img/cars/01.jpg'],
            ['car_id' => 79, 'image_path' => 'front/img/cars/02.jpg'],
            ['car_id' => 80, 'image_path' => 'front/img/cars/03.jpg'],
            ['car_id' => 80, 'image_path' => 'front/img/cars/04.jpg'],
            ['car_id' => 80, 'image_path' => 'front/img/cars/05.jpg'],
            ['car_id' => 81, 'image_path' => 'front/img/cars/06.jpg'],
            ['car_id' => 81, 'image_path' => 'front/img/cars/01.jpg'],
            ['car_id' => 81, 'image_path' => 'front/img/cars/02.jpg'],
            ['car_id' => 82, 'image_path' => 'front/img/cars/03.jpg'],
            ['car_id' => 82, 'image_path' => 'front/img/cars/04.jpg'],
            ['car_id' => 82, 'image_path' => 'front/img/cars/05.jpg'],
            ['car_id' => 83, 'image_path' => 'front/img/cars/06.jpg'],
            ['car_id' => 83, 'image_path' => 'front/img/cars/01.jpg'],
            ['car_id' => 83, 'image_path' => 'front/img/cars/02.jpg'],
            ['car_id' => 84, 'image_path' => 'front/img/cars/03.jpg'],
            ['car_id' => 84, 'image_path' => 'front/img/cars/04.jpg'],




            // Add more entries as needed
        ];

        DB::table('car_gallery')->insert($galleries);
    }
}
