<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ad;

class AdController extends Controller
{
    public function getLatestAd()
    {
        $ad = Ad::latest()->first(); // جلب أحدث إعلان

        if (!$ad) {
            return response()->json(['message' => 'No ads found'], 404);
        }

        return response()->json([
            'image' => asset('storage/' . $ad->image) // تحويل الصورة إلى رابط كامل
        ], 200);
    }

}
