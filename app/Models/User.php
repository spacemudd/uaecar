<?php

namespace App\Models;

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'name',
        'phone_number',
        'email_address',
        'pickup_city',
    ];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class, 'user_id');
    }

    public function mobileInvoices(): HasMany
    {
        return $this->hasMany(MobileInvoice::class, 'user_id');
    }
}
