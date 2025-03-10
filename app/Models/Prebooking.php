<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prebooking extends Model
{
    use HasFactory;

    protected $table = 'prebooking'; // اسم الجدول في قاعدة البيانات

    protected $fillable = [
        'user_id',
        'customer_name',
        'phone_number',
        'email',
        'pickup_city',
        'pickup_date',
        'return_date',
        'car_details',
        'total_days',
        'deposite_amount',
        'total_amount',
    ];

    // علاقة مع المستخدم (اختياري إذا كنت تحتاج ربط الحجز بالمستخدم)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
