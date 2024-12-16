<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = ['code', 'discount', 'usage_limit'];

    public static function validateCoupon($code)
    {
        $coupon = Coupon::where('code', $code)->first();
        if ($coupon && $coupon->usage_limit > 0) {
            return $coupon;
        }
        return null;
    }
}
