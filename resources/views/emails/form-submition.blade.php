<!DOCTYPE html>
<html>
<head>
    <title>New Booking Request</title>
</head>
<body>
    <!-- <img src="{{ asset('front/img/header.png') }}" alt="Header Image" style="width: 100%; height: auto;"> -->
    <h1>New Booking Request</h1>

    <h3>Customer Information</h3>
    <p><strong>Name:</strong> {{ $data['name'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>Phone:</strong> {{ $data['phone'] }}</p>
    <p><strong>Pick Up City:</strong> {{ $data['pickup_city'] }}</p>
    <p><strong>Pick Up Date:</strong> {{ $data['pickup_date'] }}</p>
    <p><strong>Return Date:</strong> {{ $data['return_date'] }}</p>
    <p><strong>Message:</strong> {{ $data['message'] }}</p>

    <h3>Car Booked Information</h3>
    <p><strong>Car id: #</strong> {{ $data['carID'] }}</p>
    <p><strong>Car:</strong> {{ $data['carName'] }}</p>
    <p><strong>Car Daily Price: {{ $data['daily_car_price'] }}</strong></p>
    <p>For more details, visit the car's page: <a href="{{ $carDetailsUrl }}">{{ $carDetailsUrl }}</a></p>
</body>
</html>
