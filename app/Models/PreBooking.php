<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreBooking extends Model
{
    use HasFactory;

    protected $table = 'pre_booking'; // تأكد من أن اسم الجدول صحيح

    protected $fillable = [
        'user_id',
        'car_name',
        'car_model',
        'car_daily_price',
        'car_weekly_price',
        'car_monthly_price',
        'total_days',
        'total_amount',
        'plate_number',
    ];
}
