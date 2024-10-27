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
        'seats', 
        'gear', 
        'price_daily', 
        'price_weekly', 
        'price_monthly', 
        'car_picture', 
        'doors', 
        'description', 
        'plate_number', 
        'make',
        'model', 
        'year', 
        'color', 
        'categories', 
        'status', 
        'expected_return_date',
        'upcoming_reservation', 
        'chassis_number', 
        'delivery',
        'kilo_daily',
        'kilo_monthly',
        'navigation',
        'is_visible',

    ];


    public function gallery(): HasMany
    {
        return $this->hasMany(CarImage::class, 'car_id');
    }
}
