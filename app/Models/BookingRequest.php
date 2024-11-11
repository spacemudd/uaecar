<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingRequest extends Model
{
    use HasFactory;

    protected $table = 'booking_request';
    protected $fillable = [
        'request_number',
        'car_id',
        'car_name',
        'name',
        'email',
        'phone',
        'pickup_city',
        'pickup_date',
        'return_date',
        'message',
        'daily_car_price',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id');
    }
}
