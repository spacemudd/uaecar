@extends('back.layouts.master')

@section('content')
<!-- Bootstrap Container for the page layout -->

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<div class="wrapper">
    <div class="container mt-5">
        <div class="page-inner">
            <!-- Page Header -->
            <div class="page-header mb-4">
                <h3 class="fw-bold mb-3">Booking Request Profile - #{{ $bookingRequest->request_number }}</h3>
            </div>

            <!-- Profile Card -->
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h4>Booking Details</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Car Image and Customer Details -->
                            <div class="row">
                            
                                <div class="col-md-8">
                                    <!-- Customer and Booking Information -->
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <th>Customer Name:</th>
                                                <td>{{ $bookingRequest->name }}</td>
                                            </tr>

                                            <tr>
                                                <th>Phone Number:</th>
                                                <td>
                                                    <!-- WhatsApp Icon with the Phone Number -->
                                                    <a href="https://wa.me/{{ $bookingRequest->phone }}" target="_blank" class="btn btn-success btn-sm">
                                                        <i class="fab fa-whatsapp"></i> {{ $bookingRequest->phone }}
                                                    </a>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th>Email:</th>
                                                <td>{{ $bookingRequest->email }}</td>
                                            </tr>
                                            <tr>
                                                <th>Pickup Date:</th>
                                                <td>{{ \Carbon\Carbon::parse($bookingRequest->pickup_date)->format('F j, Y') }}</td>
                                            </tr>
                                            <tr>
                                                <th>Return Date:</th>
                                                <td>{{ \Carbon\Carbon::parse($bookingRequest->return_date)->format('F j, Y') }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Status Box on the Right Side -->
                <div class="col-md-4">
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h4>Status & Rental Details</h4>
            </div>
        </div>
        <div class="card-body text-center">
            <!-- Status Box -->
            <span class="badge 
                @if($bookingRequest->status == 'Pending')
                    bg-warning text-dark
                @elseif($bookingRequest->status == 'Approved')
                    bg-success text-white
                @elseif($bookingRequest->status == 'Canceled')
                    bg-danger text-white
                @else
                    bg-secondary text-white
                @endif
            ">
                {{ $bookingRequest->status }}
            </span>
            
            <!-- Car and Pricing Information -->
            <div class="mt-4">
    <table class="table table-borderless">
        <tbody>
            <!-- Car Image (Centered and Enlarged) -->
            <tr>
                <td colspan="2" class="text-center">
                    <img src="{{ asset('storage/' . $carPicture) }}" alt="Car Image" class="img-fluid" style="max-width: 300px; height: auto;">
                </td>
            </tr>

            <!-- Car Name -->
            <tr>
                <th class="text-left font-weight-bold">Car Name:</th>
                <td>{{ $bookingRequest->car->car_name. ' ' . $bookingRequest->car->model . ' ' . $bookingRequest->car->year?? 'N/A' }}</td>
            </tr>

            <!-- Rental Pricing -->
            <tr>
                <th class="text-left font-weight-bold">Daily Price:</th>
                <td>AED {{ number_format($bookingRequest->car->price_daily, 2) }}</td>
            </tr>
            <tr>
                <th class="text-left font-weight-bold">Weekly Price:</th>
                <td>AED {{ number_format($bookingRequest->car->price_weekly, 2) }}</td>
            </tr>
            <tr>
                <th class="text-left font-weight-bold">Monthly Price:</th>
                <td>AED {{ number_format($bookingRequest->car->price_monthly, 2) }}</td>
            </tr>

            <!-- Calculate Days Rented -->
            <tr>
                <th class="text-left font-weight-bold">Days Rented:</th>
                <td>{{ \Carbon\Carbon::parse($bookingRequest->pickup_date)->diffInDays(\Carbon\Carbon::parse($bookingRequest->return_date)) }} days</td>
            </tr>

            <!-- Calculate Total Amount -->
<!-- Calculate Total Amount -->
<tr>
    <th class="text-left font-weight-bold">Total Amount:</th>
    <td>
        @php
            $daysRented = \Carbon\Carbon::parse($bookingRequest->pickup_date)->diffInDays(\Carbon\Carbon::parse($bookingRequest->return_date));
            $totalAmount = $daysRented > 0 ? $bookingRequest->car->price_daily * $daysRented : 0;
        @endphp

        @if($totalAmount > 0)
            AED {{ number_format($totalAmount, 2) }}
        @else
            Invalid dates or no rental days
        @endif
    </td>
</tr>

        </tbody>
    </table>
</div>


                <!-- In your Blade view -->
                <form action="{{ route('bookingRequests.updateStatus', $bookingRequest->id) }}" method="POST" class="mt-3">
                    @csrf
                    @method('PATCH')

                    <!-- Status Update Buttons -->
                    <div class="btn-group">
                        <button type="submit" name="status" value="Approved" class="btn btn-success">Approved</button>
                        <button type="submit" name="status" value="Canceled" class="btn btn-danger">Canceled</button>
                    </div>
                </form>

        </div>
    </div>
</div>

            </div>
        </div>
    </div>
</div>

@endsection
