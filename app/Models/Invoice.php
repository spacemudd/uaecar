<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'customer_email',
        'customer_phone',
        'city',
        'pickup_date',
        'return_date',
        'creation_date',
        'description',
        'car_daily_price',
        'total_days',
        'total_amount',
        'tax',
        'status',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'invoice_id');
    }
}
