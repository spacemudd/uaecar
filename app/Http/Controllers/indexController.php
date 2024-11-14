<?php

namespace App\Http\Controllers;
use App\Models\Car;

use Illuminate\Http\Request;

class indexController extends Controller
{
    //


    public function showData(Request $request)
    {
        // تحقق إذا كان هناك فلتر تم تحديده
        $order = $request->input('price_filter', 'default'); // 'default' إذا لم يتم اختيار الفلتر

        $carsQuery = Car::query();

        // إذا كان الفلتر هو من الأقل إلى الأعلى
        if ($order === 'low-to-high') {
            $carsQuery->orderBy('price_daily', 'asc');
        }
        // إذا كان الفلتر هو من الأعلى إلى الأقل
        elseif ($order === 'high-to-low') {
            $carsQuery->orderBy('price_daily', 'desc');
        } 
        // إذا لم يتم اختيار أي فلتر، سيتم استخدام الترتيب الافتراضي (من الأعلى إلى الأقل)
        else {
            $carsQuery->orderBy('price_daily', 'desc');
        }

        $cars = $carsQuery->get(); // الحصول على النتائج بناءً على الفلتر

        return view("front.pages.index", compact("cars"));
    }


    public function showVisibleCars()
    {
        $cars = Car::where('is_visible', true)->orderBy('price_daily', 'desc')->get();
        return view("front.pages.index", compact("cars"));
    }

}
