<!DOCTYPE html>
<html>
<head>
    <title>New Booking Request</title>
</head>
<body>
    <h1>New Booking Request</h1>
    <p><strong>Name:</strong> {{ $data['name'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>Phone:</strong> {{ $data['phone'] }}</p>
    <p><strong>Pick Up City:</strong> {{ $data['pickup_city'] }}</p>
    <p><strong>Pick Up Date:</strong> {{ $data['pickup_date'] }}</p>
    <p><strong>Return Date:</strong> {{ $data['return_date'] }}</p>
    <p><strong>Message:</strong> {{ $data['message'] }}</p>


</body>
</html>
