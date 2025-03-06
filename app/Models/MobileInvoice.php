<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MobileInvoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'car_id',
        'total_amount',
        'total_days',
        'security_deposit',
        'pickup_date',
        'return_date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }
}
