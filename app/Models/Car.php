<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Car extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $casts = [
        'at_data' => 'json',
    ];

    protected $fillable = [
        'description',
        'description2',
        'long_description',
        'year',
        'engine_size',
        'mileage',
        'price',
        'fuel_type',
        'registration',
        'owners',
        'emission_class',
        'at_stock_id',
        'at_advertiserAdvert',
        'at_make',
        'at_model',
        'at_derivative',
        'at_description',
        'at_description2',
        'at_published',
        'at_total_price',
        'at_last_synced',
        'at_data',
    ];

    protected $appends = [
        'price_human',
    ];

    public function getPriceHumanAttribute()
    {
        if ($this->at_data['data'] ?? false) {
            return '£'.number_format($this->at_data['data']['adverts']['retailAdverts']['totalPrice']['amountGBP'] ?? $this->price, 2);
        }
        return '£'.number_format($this->price, 2);
    }


    public function images()
    {
        return $this->hasMany(CarImage::class);
    }


}
