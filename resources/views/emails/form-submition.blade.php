<!DOCTYPE html>
<html>
<head>
    <title>New Booking Request</title>
</head>
<body>
    <h1>New Booking Request</h1>
    <p><strong>Name:</strong> {{ $data['full_name'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>Phone:</strong> {{ $data['phone'] }}</p>
    <p><strong>Date From:</strong> {{ $data['date_from'] }}</p>
    <p><strong>Date To:</strong> {{ $data['date_to'] }}</p>
    <p><strong>Pickup City:</strong> {{ $data['pickup_city'] }}</p>
    <p><strong>Selected Car:</strong> {{ $data['selected_car'] }}</p>
</body>
</html>
