<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\BookingRequest;
use App\Models\InstagramPost;
use App\Models\Invoice;
use App\Models\Order;

class adminDashboardController extends Controller
{
    //

    public function index(){

        $car_count = Car::count();
        $invoice_count = Invoice::count();
        $order_count = Order::count();
        $pendingBookings = BookingRequest::where('status', 'Pending')->count();
        $approvedBookings = BookingRequest::where('status', 'Approved')->count();
        $canceledBookings = BookingRequest::where('status', 'Canceled')->count();



        $booking = BookingRequest::count();

        return view('back.pages.dashboard', compact('car_count', 'booking','pendingBookings', 'approvedBookings', 'canceledBookings', 'invoice_count', 'order_count'));
    }


    public function addCars(){
        return view('back.pages.addcars');
    }

    public function showCarList(){

        $cars = Car::all(); 

        return view('back.pages.carlist', compact("cars"));
    }

    public function showInstagramForm()
    {
        $posts = InstagramPost::all();
    
        return view('back.pages.instagram', compact('posts'));
    }
    
    public function storeInstagramPost(Request $request)
    {
        // معالجة البيانات المستلمة وتحديث السجلات أو إضافتها إلى قاعدة البيانات
        InstagramPost::updateOrCreate([
            'post_id' => $request->post_id,
        ], [
            'url' => $request->url,
        ]);
    
        return redirect()->route('instagram.form')->with('success', 'Instagram posts updated successfully!');
    }
    
}
