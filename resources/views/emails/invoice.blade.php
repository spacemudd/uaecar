<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
</head>
<body>
    <h2>Invoice for your car rental</h2>
    <p>Dear {{ $invoice->customer_name }},</p>
    <p>Thank you for using RentLuxuria. Your invoice details are as follows:</p>
    <ul>
        <li><strong>Car Name:</strong> {{ $invoice->car_name }}</li>
        <li><strong>Pick-up Date:</strong> {{ $invoice->pickup_date }}</li>
        <li><strong>Return Date:</strong> {{ $invoice->return_date }}</li>
        <li><strong>Total Amount:</strong> {{ $invoice->total_amount }} AED</li>
    </ul>
    <p>If you have any questions, feel free to contact us.</p>
</body>
</html>
