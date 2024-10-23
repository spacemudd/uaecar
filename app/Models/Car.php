<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'node_id',
        'car_name',
        'car_model',
        'car_model_year',
        'plate_number',
        'categories',
        'seats',
        'doors',
        'price_daily',
        'price_weekly',
        'price_monthly',
        'car_transmission',
        'car_description',
        'chassis_number',
        'color',
        'car_image',
        'car_gallery',
    ];


    public function gallery(): HasMany
    {
        return $this->hasMany(CarImage::class, 'car_id');
    }
}
