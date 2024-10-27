<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CarImage;
use App\Models\Car; // Import the Car model for checking existence

class CarGallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carData = [
            ['car_id' => 18, 'images' => [
                'front/img/gallery/Rang Rover V6 2024/2024-Land-Rover-Range-Rover-SV-P615-a.jpg',
                'front/img/gallery/Rang Rover V6 2024/2024-Land-Rover-Range-Rover-SV-P615-b.jpg',
                'front/img/gallery/Rang Rover V6 2024/2024-Land-Rover-Range-Rover-SV-P615-qkdg054ixkpyzmyw2fwxk7vwy2lyihna7z95ykoarg.jpg',
            ]],
            ['car_id' => 14, 'images' => [
                'front/img/gallery/Mercedes Benz S500/Le15.jpg',
                'front/img/gallery/Mercedes Benz S500/WhatsApp Image 2024-10-20 at 5.29.26 PM (1).jpeg',
                'front/img/gallery/Mercedes Benz S500/WhatsApp Image 2024-10-20 at 5.29.26 PM.jpeg',
            ]],
            ['car_id' => 17, 'images' => [
                'front/img/gallery/Land Rover V6 2022/WhatsApp Image 2024-10-20 at 5.04.57 PM.jpeg',
                'front/img/gallery/Land Rover V6 2022/WhatsApp Image 2024-10-20 at 5.04.59 PM (1).jpeg',
                'front/img/gallery/Land Rover V6 2022/WhatsApp Image 2024-10-20 at 5.04.59 PM.jpeg',
            ]],
            ['car_id' => 16, 'images' => [
                'front/img/gallery/Land Rover V4 2024/WhatsApp Image 2024-10-20 at 4.43.03 PM (1).jpg',
                'front/img/gallery/Land Rover V4 2024/WhatsApp Image 2024-10-20 at 4.43.04 PM (1).jpeg',
                'front/img/gallery/Land Rover V4 2024/WhatsApp Image 2024-10-20 at 4.43.04 PM.jpg',
            ]],
            ['car_id' => 1, 'images' => [
                'front/img/gallery/Toyota Haice/202407091940254717384.jpeg',
                'front/img/gallery/Toyota Haice/202407091945044872846.jpg',
                'front/img/gallery/Toyota Haice/202407091948164717277.jpg',

            ]],
            ['car_id' => 2, 'images' => [
                'front/img/gallery/Infiniti QX50/2019-infiniti-qx50-ltwrapup-1583843542.jpg',
                'front/img/gallery/Infiniti QX50/2021_infiniti_qx50_13_2560x1440.jpg',
                'front/img/gallery/Infiniti QX50/DSC_9260-hero.jpg',
            ]],
            ['car_id' => 3, 'images' => [
                'front/img/gallery/Honda Odesy/2018_honda_odyssey_9_2560x1440.jpg',
                'front/img/gallery/Honda Odesy/2018_honda_odyssey_14_2560x1440.jpg',
                'front/img/gallery/Honda Odesy/honda_odyssey_875018.png',
            ]],
            ['car_id' => 8, 'images' => [
                'front/img/gallery/BMW 228/bmw-2-reeks-gran-coupe-2020-specs-03.jpg',
                'front/img/gallery/BMW 228/24Bmw2se218iMSpoComPac4drBlaFR7_800.jpg',
            ]],
            ['car_id' => 7, 'images' => [
                'front/img/gallery/Mistubisi outlender/d6h34k0lclaol4jh0qypj7qfv1sc71su.webp',
                'front/img/gallery/Mistubisi outlender/P62_225_24OutlanderPHEV-01-Rear-L.jpg',
                'front/img/gallery/Mistubisi outlender/Screenshot 2024-10-26 002307.jpg',
            ]],
            ['car_id' => 13, 'images' => [
                'front/img/gallery/Hyundai ELANTRA/7-2048x1152.jpg',
                'front/img/gallery/Hyundai ELANTRA/3074079.jpg',
                'front/img/gallery/Hyundai ELANTRA/img_001.jpg',
            ]],
            ['car_id' => 20, 'images' => [
                'front/img/gallery/chevorlet malibu/0f27959cae90e909b35c3322f8ae5d9865d58ee4.jpg',
                'front/img/gallery/chevorlet malibu/1568365792.jpg',
                'front/img/gallery/chevorlet malibu/خارجية_سيارة_ماليبو.jpg',
            ]],
            ['car_id' => 12, 'images' => [
                'front/img/gallery/Nissan Altim/5_2021_nissan_altima.jpg',
                'front/img/gallery/Nissan Altim/2019_nissan_altima_22_2560x1440.jpg',
                'front/img/gallery/Nissan Altim/Glacier-White.jpg',
            ]],
            ['car_id' => 5, 'images' => [
                'front/img/gallery/Hyundai Sonata/5f2ed18866b60ec28488fb1815c76e86.jpg',
                'front/img/gallery/Hyundai Sonata/2020-Hyundai--Sonata-1.jpg',
                'front/img/gallery/Hyundai Sonata/1570544518_85.jpg',
            ]],
            ['car_id' => 11, 'images' => [
                'front/img/gallery/Hyundai VENEU/2020-hyundai-venue-109-1555517585.jpg',
                'front/img/gallery/Hyundai VENEU/2530028.jpg',
                'front/img/gallery/Hyundai VENEU/f207b4ed0237dd2584eb9e9e81fdd997.jpg',
            ]],
            ['car_id' => 6, 'images' => [
                'front/img/gallery/Hyandai Santa FE/hyundai_santa_fe_2021_07.jpg',
                'front/img/gallery/Hyandai Santa FE/hyundai-santa-fe-us-version-2021-1600-1d.jpg',
                'front/img/gallery/Hyandai Santa FE/scale_1200.jpg',
            ]],
            ['car_id' => 9, 'images' => [
                'front/img/gallery/Kia Certo/2019-kia-forte-1166-image.jpg',
                'front/img/gallery/Kia Certo/1580888802_vya.jpg',
                'front/img/gallery/Kia Certo/820182024947903062818.jpg',
            ]],
            ['car_id' => 19, 'images' => [
                'front/img/gallery/Nissan Versa/LQL5XWKA2FDUDOSTWQDOQ.jpg',
                'front/img/gallery/Nissan Versa/LQL5XWKA2FDUDOSTWQGISCADOQ.jpg',
                'front/img/gallery/Nissan Versa/the-nissan-versa-modern-2019.jpg',
            ]],
            ['car_id' => 4, 'images' => [
                'front/img/gallery/Nissan Sunny/3513bf6c991dbd686ee84b69781fe186cdc59e3b_med.jpg',
                'front/img/gallery/Nissan Sunny/fb9b757b7e70c47ea6201a4d2f1064f1491993b6.jpg',
                'front/img/gallery/Nissan Sunny/l-1653590343.267-628fc947412ed.png',
            ]],
        ];

        foreach ($carData as $data) {
            $car_id = $data['car_id'];
            if (Car::where('id', $car_id)->exists()) {
                foreach ($data['images'] as $image) {
                    CarImage::create(['car_id' => $car_id, 'image_path' => $image]);
                }
            }
        }
    }
}
