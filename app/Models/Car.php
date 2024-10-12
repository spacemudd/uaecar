<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_name',
        'seats',
        'gear',
        'bags',
        'price',
        'car_picture',
        'doors',
        'air_condition',
        'age',
        'description',
    ];

    /**
     * Get the images for the car.
     */
    public function gallery(): HasMany
    {
        // Specify the table name if it doesn't follow the plural convention
        return $this->hasMany(CarImage::class, 'car_id');
    }
}
