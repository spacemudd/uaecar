<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\BookingRequest;
use App\Models\Car;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    //

    public function bookingList(){
        $booking_request = BookingRequest::all();
        return view('back.pages.bookinglist', compact('booking_request'));

    }


    public function deleteAll(){
        BookingRequest::truncate();  // This deletes all records in the table

        // Redirect back with a success message
        return redirect()->route('back-pages.bookinglist')->with('success', 'All booking requests have been deleted.');
    }


    public function requestProfile($id){

        $bookingRequest = BookingRequest::findOrFail($id);
        $carPicture = $bookingRequest->car->car_picture;

        $daysRented = \Carbon\Carbon::parse($bookingRequest->pickup_date)->diffInDays(\Carbon\Carbon::parse($bookingRequest->return_date));
    
        // Calculate the total amount (Daily price * Days rented)
        $totalAmount = $bookingRequest->car->daily_price * $daysRented;

        // Return the view with the booking request data
        return view('back.pages.bookingDetails', compact('bookingRequest', 'carPicture', 'totalAmount'));

    }
}
