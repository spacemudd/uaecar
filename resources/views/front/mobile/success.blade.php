<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .success-message {
            margin-top: 100px;
            text-align: center;
        }
        .success-icon {
            font-size: 100px;
            color: #28a745; /* Green color */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="success-message">
            <div class="success-icon">
                <i class="fas fa-check-circle"></i> <!-- Success icon -->
            </div>
            <h1>Payment Successful!</h1>
            <p>Thank you for using our services. You will receive a confirmation email shortly.</p>
            <a href="{{ url('/') }}" class="btn btn-success btn-lg">Return to Home</a>
            <p>الحجز ناجح للمستخدم: {{ $userId }}</p>
            <p>السيارة المحجوزة: {{ $carId }}</p>

        </div>
    </div>

    <!-- Adding Font Awesome library for icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
