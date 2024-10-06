<?php

namespace App\Services;

use App\Models\Car;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Olsgreen\AutoTrader\Client;

class AutoTraderService
{
    private $client;
    private $advertiser_id;

    public function stock()
    {
        $this->advertiser_id = config('autotrader.advertiser_id');

        if (Cache::get('autotrader_access_token')) {
            $token = Cache::get('autotrader_access_token');
        } else {
            $key = config('autotrader.key');
            $secret = config('autotrader.secret');
            $api = new Client(['sandbox' => false]);
            $token = $api->authentication()->getAccessToken($key, $secret);
            Cache::put('autotrader_access_token', $token, 900);
        }

        // once you have your access token you can create client instances like:
        $this->client = new Client(['access_token' => $token, 'sandbox' => false]);

        return $this->client->stock()->all($this->advertiser_id, 1, 50);
    }

    public function updateCarFromNotification($stock_id, $data)
    {
        $car = Car::where('at_stock_id', $stock_id)->first();

        $data = json_decode($data, true);
        $car->at_data = $data;

        if ($car->aa_last_webhook_at) {
            if (Carbon::parse($data['time']) <= $car->aa_last_webhook_at) {
                return response()->json([
                    'success' => false,
                    'msg' => 'Car already updated on: ' . $car->aa_last_webhook_at. ' (received webhook time: '. $data['time'] .')',
                ]);
            }
        }

        $car->price = array_key_exists('amountGBP', $data['data']['adverts']['retailAdverts']['totalPrice']) ? $data['data']['adverts']['retailAdverts']['totalPrice']['amountGBP'] : null;
        $car->mileage = array_key_exists('odometerReadingMiles', $data['data']['vehicle']) ? $data['data']['vehicle']['odometerReadingMiles'] : '';

        $car->description = array_key_exists('description', $data['data']['adverts']['retailAdverts']) ? $data['data']['adverts']['retailAdverts']['description'] : null;
        $car->at_description = array_key_exists('description', $data['data']['adverts']['retailAdverts']) ? $data['data']['adverts']['retailAdverts']['description'] : null;

        $car->description2 = array_key_exists('description2', $data['data']['adverts']['retailAdverts']) ? $data['data']['adverts']['retailAdverts']['description2'] : null;
        $car->at_description2 = array_key_exists('description2', $data['data']['adverts']['retailAdverts']) ? $data['data']['adverts']['retailAdverts']['description2'] : null;

        $car->at_published = $data['data']['adverts']['retailAdverts']['advertiserAdvert']['status'] ?? 'NOT_PUBLISHED';
        $car->aa_last_webhook_at = Carbon::parse($data['time']);

        $car->save();

        if (count($data['data']['media']['images'])) {
            // clear images
            $car->clearMediaCollection('images');

            foreach ($data['data']['media']['images'] as $image) {
                $car->addMediaFromUrl($image['href'])->toMediaCollection('images');
            }
        }

        if ($data['data']['media']['video']['href'] ?? null) {
            // clear video
            $car->clearMediaCollection('videos');

            $car->addMediaFromUrl($data['data']['media']['video']['href'])->toMediaCollection('videos');
        }

        $logs[] = [
            'stock_id' => $stock_id,
            'car' => $car->id,
            'msg' => 'Car updated successfully',
        ];

        return response()->json([
            'success' => true,
            'logs' => $logs,
        ]);
    }

    public function createNewCar($stock_id, $aa_data)
    {
        $logs = [];

        $vehicle = $aa_data['data'];

        $car = Car::create([
            'description' => array_key_exists('description', $vehicle['adverts']['retailAdverts']) ? $vehicle['adverts']['retailAdverts']['description'] : null,
            'description2' => array_key_exists('description2', $vehicle['adverts']['retailAdverts']) ? $vehicle['adverts']['retailAdverts']['description2'] : null,
            'long_description' => '',
            'year' => array_key_exists('yearOfManufacture', $vehicle['vehicle']) ? $vehicle['vehicle']['yearOfManufacture'] : null,
            'engine_size' => array_key_exists('badgeEngineSizeLitres', $vehicle['vehicle']) ? $vehicle['vehicle']['badgeEngineSizeLitres'] : null,
            'mileage' => array_key_exists('odometerReadingMiles', $vehicle['vehicle']) ? $vehicle['vehicle']['odometerReadingMiles'] : null,
            'price' => array_key_exists('amountGBP', $vehicle['adverts']['retailAdverts']['totalPrice']) ? $vehicle['adverts']['retailAdverts']['totalPrice']['amountGBP'] : null,
            'fuel_type' => array_key_exists('fuelType', $vehicle['vehicle']) ? $vehicle['vehicle']['fuelType'] : null,
            'registration' => array_key_exists('firstRegistrationDate', $vehicle['vehicle']) ? $vehicle['vehicle']['firstRegistrationDate'] : '',
            'owners' => $vehicle['vehicle']['owners'] ?? 0,
            'emission_class' => $vehicle['vehicle']['emissionClass'] ?? null,
            'at_stock_id' => $vehicle['metadata']['stockId'] ?? null,
            'at_advertiserAdvert' => $vehicle['advertiser']['advertiserId'] ?? null,
            'at_make' => $vehicle['vehicle']['make'] ?? null,
            'at_model' => $vehicle['vehicle']['model'] ?? null,
            'at_derivative' => array_key_exists('derivative', $vehicle['vehicle']) ? $vehicle['vehicle']['derivative'] : null,
            'at_description' => array_key_exists('description', $vehicle['adverts']['retailAdverts']) ? $vehicle['adverts']['retailAdverts']['description'] : null,
            'at_description2' => array_key_exists('description2', $vehicle['adverts']['retailAdverts']) ? $vehicle['adverts']['retailAdverts']['description2'] : null,
            'at_published' => $vehicle['adverts']['retailAdverts']['autotraderAdvert']['status'],
            'at_total_price' => array_key_exists('amountGBP', $vehicle['adverts']['retailAdverts']['totalPrice']) ? $vehicle['adverts']['retailAdverts']['totalPrice']['amountGBP'] : null,
            'at_last_synced' => now(),
            'aa_last_webhook_at' => Carbon::parse($aa_data['time']),
            'at_data' => $vehicle,
        ]);

        foreach ($vehicle['media']['images'] as $image) {
            $car->addMediaFromUrl($image['href'])->toMediaCollection('images');
        }

        if (array_key_exists('href', $vehicle['media']['video'])) {
            if ($vehicle['media']['video']['href']) {
                $car->addMediaFromUrl($vehicle['media']['video']['href'])->toMediaCollection('videos');
            }
        }

        $logs[] = [
            'stock_id' => $stock_id,
            'msg' => 'Car created successfully',
        ];

        return response()->json([
            'success' => true,
            'logs' => $logs,
        ]);
    }
}
