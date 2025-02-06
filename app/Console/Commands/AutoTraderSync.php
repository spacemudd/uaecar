<?php

namespace App\Console\Commands;

use App\Models\Car;
use App\Services\AutoTraderService;
use Illuminate\Console\Command;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class AutoTraderSync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:auto-trader-sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $counter = 0;

        $vehicles = app()->make(AutoTraderService::class)->stock();

        Media::truncate();
        Car::truncate();

        foreach ($vehicles['results'] as $vehicle) {
            $current_images = 0;
            $limit = 100;

            $car = \App\Models\Car::create([

                'description' => array_key_exists('description', $vehicle['adverts']['retailAdverts']) ? $vehicle['adverts']['retailAdverts']['description'] : '',
                'description2' => array_key_exists('description2', $vehicle['adverts']['retailAdverts']) ? $vehicle['adverts']['retailAdverts']['description2'] : '',

                'long_description' => '',
                'year' => $vehicle['vehicle']['yearOfManufacture'],
                'engine_size' => $vehicle['vehicle']['badgeEngineSizeLitres'],
                'mileage' => $vehicle['vehicle']['odometerReadingMiles'],
                'price' => $vehicle['adverts']['retailAdverts']['totalPrice']['amountGBP'],
                'fuel_type' => $vehicle['vehicle']['fuelType'],
                'registration' => $vehicle['vehicle']['firstRegistrationDate'],
                'owners' => $vehicle['vehicle']['owners'] ?? 0,
                'emission_class' => $vehicle['vehicle']['emissionClass'],
                'at_stock_id' => $vehicle['metadata']['stockId'],
                'at_advertiserAdvert' => $vehicle['advertiser']['advertiserId'],
                'at_make' => $vehicle['vehicle']['make'],
                'at_model' => $vehicle['vehicle']['model'],
                'at_derivative' => $vehicle['vehicle']['derivative'],
                'at_description' => $vehicle['adverts']['retailAdverts']['description'],
                'at_description2' => $vehicle['adverts']['retailAdverts']['description2'],
                'at_published' => $vehicle['adverts']['retailAdverts']['autotraderAdvert']['status'],
                'at_total_price' => $vehicle['adverts']['retailAdverts']['totalPrice']['amountGBP'],
                'at_last_synced' => now(),
                'at_data' => ['data' => $vehicle],
            ]);

            foreach ($vehicle['media']['images'] as $image) {
                if ($current_images >= $limit) {
                    continue;
                }
                $car->addMediaFromUrl($image['href'])->toMediaCollection('images');
                ++$current_images;
            }

            if ($vehicle['media']['video']['href']) {
                $car->addMediaFromUrl($vehicle['media']['video']['href'])->toMediaCollection('videos');
            }

            $this->info('Added car: ' . $car->id. ' - Counter: '. ++$counter);
        }
    }
}
