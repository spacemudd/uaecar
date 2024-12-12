<!-- resources/views/email/invoice.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
</head>
<body>
    <h1>Invoice Details</h1>
    <p>Dear {{ $invoice->customer_name }},</p>
    <p>Here are the details of your invoice:</p>
    <ul>
        <li><strong>Invoice ID:</strong> #{{ $invoice->id }}</li>
        <li><strong>Pickup City:</strong> {{ $invoice->city }}</li>
        <li><strong>Pickup Date:</strong> {{ $invoice->pickup_date }}</li>
        <li><strong>Total Amount:</strong> {{ $invoice->total_amount }} AED</li>
        <li><strong>Tax:</strong> {{ $invoice->tax }} AED</li>
    </ul>
    <p>Thank you for your purchase!</p>
</body>
</html>
