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


    public function gallery(): HasMany
    {
        return $this->hasMany(CarImage::class, 'car_id');
    }
}
