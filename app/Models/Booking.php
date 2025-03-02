<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    
    protected $table = 'booking'; // إضافة هذه السطر لتحديد اسم الجدول

    protected $fillable = [
        'user_id',
        'car_id',
        'pickup_date',
        'return_date',
        'total_days',
        'total_amount',
    ];

    // يمكنك إضافة علاقات إذا كنت بحاجة إليها، مثل:
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
