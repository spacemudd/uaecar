<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Car;

class CarSeeder extends Seeder
{
    public function run()
    {
        $cars = [
            [
                'car_name' => 'Toyota Camry',
                'seats' => 5,
                'gear' => 'Automatic',
                'bags' => 2,
                'price' => 50,
                'car_picture' => 'front/img/cars/01.jpg',
                'doors' => 4,
                'air_condition' => true,
                'age' => 2,
                'description' => 'A comfortable midsize car.'
            ],
            [
                'car_name' => 'Honda Civic',
                'seats' => 5,
                'gear' => 'Automatic',
                'bags' => 2,
                'price' => 45,
                'car_picture' => 'front/img/cars/02.jpg',
                'doors' => 4,
                'air_condition' => true,
                'age' => 3,
                'description' => 'A reliable compact car.'
            ],
            [
                'car_name' => 'Ford Mustang',
                'seats' => 4,
                'gear' => 'Manual',
                'bags' => 1,
                'price' => 75,
                'car_picture' => 'front/img/cars/03.jpg',
                'doors' => 2,
                'air_condition' => true,
                'age' => 1,
                'description' => 'A stylish sports car.'
            ],
            [
                'car_name' => 'Chevrolet Malibu',
                'seats' => 5,
                'gear' => 'Automatic',
                'bags' => 2,
                'price' => 55,
                'car_picture' => 'front/img/cars/04.jpg',
                'doors' => 4,
                'air_condition' => true,
                'age' => 2,
                'description' => 'A midsize sedan with great features.'
            ],
            [
                'car_name' => 'Nissan Altima',
                'seats' => 5,
                'gear' => 'Automatic',
                'bags' => 2,
                'price' => 60,
                'car_picture' => 'front/img/cars/05.jpg',
                'doors' => 4,
                'air_condition' => true,
                'age' => 3,
                'description' => 'A spacious and comfortable sedan.'
            ],
            [
                'car_name' => 'Hyundai Sonata',
                'seats' => 5,
                'gear' => 'Automatic',
                'bags' => 2,
                'price' => 58,
                'car_picture' => 'front/img/cars/06.jpg',
                'doors' => 4,
                'air_condition' => true,
                'age' => 2,
                'description' => 'A modern sedan with great fuel efficiency.'
            ],
            [
                'car_name' => 'Kia Optima',
                'seats' => 5,
                'gear' => 'Automatic',
                'bags' => 2,
                'price' => 52,
                'car_picture' => 'front/img/cars/07.jpg',
                'doors' => 4,
                'air_condition' => true,
                'age' => 3,
                'description' => 'A stylish and reliable sedan.'
            ],
            [
                'car_name' => 'Volkswagen Jetta',
                'seats' => 5,
                'gear' => 'Manual',
                'bags' => 2,
                'price' => 50,
                'car_picture' => 'front/img/cars/08.jpg',
                'doors' => 4,
                'air_condition' => true,
                'age' => 2,
                'description' => 'A sporty compact sedan.'
            ],
            [
                'car_name' => 'Subaru Impreza',
                'seats' => 5,
                'gear' => 'Automatic',
                'bags' => 2,
                'price' => 55,
                'car_picture' => 'front/img/cars/09.jpg',
                'doors' => 4,
                'air_condition' => true,
                'age' => 1,
                'description' => 'A versatile and capable compact car.'
            ],
            [
                'car_name' => 'Mazda 3',
                'seats' => 5,
                'gear' => 'Automatic',
                'bags' => 2,
                'price' => 53,
                'car_picture' => 'front/img/cars/10.jpg',
                'doors' => 4,
                'air_condition' => true,
                'age' => 2,
                'description' => 'A fun-to-drive compact car.'
            ],
            [
                'car_name' => 'Dodge Charger',
                'seats' => 5,
                'gear' => 'Automatic',
                'bags' => 2,
                'price' => 65,
                'car_picture' => 'front/img/cars/11.jpg',
                'doors' => 4,
                'air_condition' => true,
                'age' => 1,
                'description' => 'A powerful full-size sedan.'
            ],
            [
                'car_name' => 'Toyota Corolla',
                'seats' => 5,
                'gear' => 'Automatic',
                'bags' => 2,
                'price' => 48,
                'car_picture' => 'front/img/cars/12.jpg',
                'doors' => 4,
                'air_condition' => true,
                'age' => 4,
                'description' => 'A compact car known for reliability.'
            ],
            [
                'car_name' => 'Honda Accord',
                'seats' => 5,
                'gear' => 'Automatic',
                'bags' => 2,
                'price' => 60,
                'car_picture' => 'front/img/cars/13.jpg',
                'doors' => 4,
                'air_condition' => true,
                'age' => 2,
                'description' => 'A spacious and comfortable sedan.'
            ],
            [
                'car_name' => 'Chevrolet Camaro',
                'seats' => 4,
                'gear' => 'Manual',
                'bags' => 1,
                'price' => 80,
                'car_picture' => 'front/img/cars/14.jpg',
                'doors' => 2,
                'air_condition' => true,
                'age' => 1,
                'description' => 'A high-performance sports car.'
            ],
            [
                'car_name' => 'Jeep Wrangler',
                'seats' => 5,
                'gear' => 'Automatic',
                'bags' => 3,
                'price' => 85,
                'car_picture' => 'front/img/cars/15.jpg',
                'doors' => 4,
                'air_condition' => true,
                'age' => 3,
                'description' => 'An iconic off-road vehicle.'
            ],
            [
                'car_name' => 'Nissan Rogue',
                'seats' => 5,
                'gear' => 'Automatic',
                'bags' => 3,
                'price' => 70,
                'car_picture' => 'front/img/cars/16.jpg',
                'doors' => 4,
                'air_condition' => true,
                'age' => 2,
                'description' => 'A versatile compact SUV.'
            ],
            [
                'car_name' => 'Ford Explorer',
                'seats' => 7,
                'gear' => 'Automatic',
                'bags' => 4,
                'price' => 90,
                'car_picture' => 'front/img/cars/17.jpg',
                'doors' => 4,
                'air_condition' => true,
                'age' => 1,
                'description' => 'A spacious and family-friendly SUV.'
            ],
            [
                'car_name' => 'Hyundai Tucson',
                'seats' => 5,
                'gear' => 'Automatic',
                'bags' => 3,
                'price' => 65,
                'car_picture' => 'front/img/cars/18.jpg',
                'doors' => 4,
                'air_condition' => true,
                'age' => 2,
                'description' => 'A compact SUV with modern features.'
            ],
            [
                'car_name' => 'Kia Sportage',
                'seats' => 5,
                'gear' => 'Automatic',
                'bags' => 3,
                'price' => 67,
                'car_picture' => 'front/img/cars/19.jpg',
                'doors' => 4,
                'air_condition' => true,
                'age' => 2,
                'description' => 'A stylish and practical compact SUV.'
            ],
            [
                'car_name' => 'Mazda CX-5',
                'seats' => 5,
                'gear' => 'Automatic',
                'bags' => 3,
                'price' => 75,
                'car_picture' => 'front/img/cars/20.jpg',
                'doors' => 4,
                'air_condition' => true,
                'age' => 1,
                'description' => 'A fun-to-drive compact SUV.'
            ],
        ];

        foreach ($cars as $car) {
            Car::create($car);
        }
    }
}
