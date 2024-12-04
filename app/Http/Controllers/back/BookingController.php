<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Car;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    //

    public function bookingList(){
        $invoices = Invoice::all();
        return view('back.pages.bookinglist', compact('invoices'));

    }


    // public function deleteAll(){
    //     BookingRequest::truncate();  // This deletes all records in the table

    //     // Redirect back with a success message
    //     return view('back.pages.bookinglist');
    // }


    // public function requestProfile($id){

    //     $bookingRequest = BookingRequest::findOrFail($id);
    //     $carPicture = $bookingRequest->car->car_picture;

    //     $daysRented = \Carbon\Carbon::parse($bookingRequest->pickup_date)->diffInDays(\Carbon\Carbon::parse($bookingRequest->return_date));
    
    //     // Calculate the total amount (Daily price * Days rented)
    //     $totalAmount = $bookingRequest->car->daily_price * $daysRented;

    //     // Return the view with the booking request data
    //     return view('back.pages.bookinglist', compact('bookingRequest', 'carPicture', 'totalAmount'));

    // }


    // public function updateStatus(Request $request, $id)
    // {
    //     // Validate the incoming request
    //     $validated = $request->validate([
    //         'status' => 'required|in:Pending,Approved,Canceled', // Accept only these status values
    //     ]);

    //     // Find the booking request by ID
    //     $bookingRequest = BookingRequest::findOrFail($id);

    //     // Update the status of the booking request
    //     $bookingRequest->status = $validated['status'];
    //     $bookingRequest->save();

    //     // Redirect back to the booking request profile page with a success message
    //     return redirect()->route('booking-requests.show', $bookingRequest->id)
    //                      ->with('success', 'Booking status updated successfully!');
    // }





}
