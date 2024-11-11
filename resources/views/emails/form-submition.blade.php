<!DOCTYPE html>
<html>
<head>
    <title>New Booking Request</title>
</head>
<!-- resources/views/emails/form-submition.blade.php -->

<body>
    <!-- <img src="{{ asset('front/img/header.png') }}" alt="Header Image" style="width: 100%; height: auto;"> -->
    <h1>New Booking Request</h1>
 
    <h3>Customer Information</h3>
    <p><strong>Booking Request #{{ $bookingRequest->request_number }}</strong></p>
    <p><strong>Name:</strong> {{ $bookingRequest->name }}</p>
    <p><strong>Email:</strong> {{ $bookingRequest->email }}</p>
    <p><strong>Phone:</strong> {{ $bookingRequest->phone }}</p>
    <p><strong>Pick Up City:</strong> {{ $bookingRequest->pickup_city }}</p>
    <p><strong>Pick Up Date:</strong> {{ $bookingRequest->pickup_date }}</p>
    <p><strong>Return Date:</strong> {{ $bookingRequest->return_date }}</p>
    <p><strong>Message:</strong> {{ $bookingRequest->message }}</p>
 
    <h3>Car Booked Information</h3>
    <p><strong>Car id: #</strong> {{ $bookingRequest->car_id }}</p>
    <p><strong>Car:</strong> {{ $bookingRequest->car_name }}</p>

    <p>For more details, click <a href="{{ $carDetailsUrl }}">here</a></p>
</body>

</html>
