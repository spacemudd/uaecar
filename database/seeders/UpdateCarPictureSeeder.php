<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class UpdateCarPictureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {



        DB::table('cars')
        ->where('id', 14)
        ->update(['car_picture' => 'front/img/cars/Mercedes Benz S500/png.png']);

        
        DB::table('cars')
        ->where('id', 18)
        ->update(['car_picture' => 'front/img/cars/Rang Rover V6 2024/png.png']);


        DB::table('cars')
        ->where('id', 17)
        ->update(['car_picture' => 'front/img/cars/Land Rover V6 2022/png.png']);


        DB::table('cars')
        ->where('id', 16)
        ->update(['car_picture' => 'front/img/cars/Land Rover V4 2024/png.png']);

        DB::table('cars')
        ->where('id', 1)
        ->update(['car_picture' => 'front/img/cars/Toyota Haice/png.png']);

        DB::table('cars')
        ->where('id', 2)
        ->update(['car_picture' => 'front/img/cars/Infiniti QX50/png.png']);

        DB::table('cars')
        ->where('id', 3)
        ->update(['car_picture' => 'front/img/cars/Honda Odesy/5.png']);


        DB::table('cars')
        ->where('id', 8)
        ->update(['car_picture' => 'front/img/cars/BMW 228/png.png']);



        DB::table('cars')
        ->where('id', 6)
        ->update(['car_picture' => 'front/img/cars/Hyandai Santa FE/png.png']);



        DB::table('cars')
        ->where('id', 7)
        ->update(['car_picture' => 'front/img/cars/Mistubisi outlender/png.png']);


        DB::table('cars')
        ->where('id', 20)
        ->update(['car_picture' => 'front/img/cars/chevorlet malibu/png.png']);

        

        DB::table('cars')
        ->where('id', 13)
        ->update(['car_picture' => 'front/img/cars/Hyundai ELANTRA/png.png']);

        DB::table('cars')
        ->where('id', 12)
        ->update(['car_picture' => 'front/img/cars/Nissan Altim/png.png']);

        DB::table('cars')
        ->where('id', 5)
        ->update(['car_picture' => 'front/img/cars/Hyundai Sonata/png.png']);

        DB::table('cars')
        ->where('id', 11)
        ->update(['car_picture' => 'front/img/cars/Hyundai VENEU/png.png']);

        DB::table('cars')
        ->where('id', 9)
        ->update(['car_picture' => 'front/img/cars/Kia Certo/png.png']);

        DB::table('cars')
        ->where('id', 19)
        ->update(['car_picture' => 'front/img/cars/Nissan Versa/png.png']);

        DB::table('cars')
        ->where('id', 4)
        ->update(['car_picture' => 'front/img/cars/Nissan Sunny/png.png']);


        // DB::table('cars')
        // ->where('id', 6)
        // ->update(['car_picture' => 'front/img/cars/hyundai-santa-fe-2023-exterior-oem-01.jpg']);

        
        // DB::table('cars')
        // ->where('id', 9)
        // ->update(['car_picture' => 'front/img/cars/kiacerato2020.jpg']);


        // DB::table('cars')
        // ->where('id', 12)
        // ->update(['car_picture' => 'front/img/cars/nissan-ultima-2022.jpg']);


        // DB::table('cars')
        // ->where('id', 13)
        // ->update(['car_picture' => 'front/img/cars/elentra2022.jpg']);


        // DB::table('cars')
        // ->where('id', 14)
        // ->update(['car_picture' => 'front/img/cars/mercedes s500.png']);


        // DB::table('cars')
        // ->where('id', 16)
        // ->update(['car_picture' => 'front/img/cars/landroverv4.jpg']);

        // DB::table('cars')
        // ->where('id', 17)
        // ->update(['car_picture' => 'front/img/cars/landroverv6.jpg']);

        // DB::table('cars')
        // ->where('id', 18)
        // ->update(['car_picture' => 'front/img/cars/rangrover.jpg']);


        // DB::table('cars')
        // ->where('id', 19)
        // ->update(['car_picture' => 'front/img/cars/nissanversa2021.jpg']);


        // DB::table('cars')
        // ->where('id', 20)
        // ->update(['car_picture' => 'front/img/cars/2023-Malibu-Cover-watermark.jpg']);


        DB::table('cars')
        ->where('id', 141)
        ->delete();


        DB::table('cars')
        ->where('id', 135)
        ->delete();

        // DB::table('cars')
        // ->where('id', 15)
        // ->delete();
    }


}
