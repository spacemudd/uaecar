<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Created</title>
</head>
<body>
    <h1>Invoice Created for {{ $invoice->customer_name }}</h1>
    <p>Invoice Details:</p>
    <ul>
        <li>Car: {{ $invoice->car_name }}</li>
        <li>Pickup Date: {{ $invoice->pickup_date }}</li>
        <li>Return Date: {{ $invoice->return_date }}</li>
        <li>Total Amount: AED {{ $invoice->total_amount }}</li>
    </ul>
</body>
</html>
