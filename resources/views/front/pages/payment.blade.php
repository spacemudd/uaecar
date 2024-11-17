<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&family=Work+Sans:wght@800&display=swap');

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            padding: 15px;
            background-color: white;
        }

        .container {
            margin: 20px auto;
            max-width: 1000px;
            background-color: white;
            padding: 0;
        }

        .form-control {
            height: 25px;
            width: 150px;
            border: none;
            border-radius: 0;
            font-weight: 800;
            padding: 0 0 5px 0;
            background-color: transparent;
            box-shadow: none;
            outline: none;
            border-bottom: 2px solid #ccc;
            margin: 0;
            font-size: 14px;
        }

        .form-control:focus {
            box-shadow: none;
            border-bottom: 2px solid #ccc;
            background-color: transparent;
        }

        .form-control2 {
            font-size: 14px;
            height: 20px;
            width: 55px;
            border: none;
            border-radius: 0;
            font-weight: 800;
            padding: 0 0 5px 0;
            background-color: transparent;
            box-shadow: none;
            outline: none;
            border-bottom: 2px solid #ccc;
            margin: 0;
        }

        .form-control2:focus {
            box-shadow: none;
            border-bottom: 2px solid #ccc;
            background-color: transparent;
        }

        .form-control3 {
            font-size: 14px;
            height: 20px;
            width: 30px;
            border: none;
            border-radius: 0;
            font-weight: 800;
            padding: 0 0 5px 0;
            background-color: transparent;
            box-shadow: none;
            outline: none;
            border-bottom: 2px solid #ccc;
            margin: 0;
        }

        .form-control3:focus {
            box-shadow: none;
            border-bottom: 2px solid #ccc;
            background-color: transparent;
        }

        p {
            margin: 0;
        }

        img {
            width: 100%;
            height: 100%;
            object-fit: fill;
        }

        .text-muted {
            font-size: 10px;
        }

        .textmuted {
            color: #6c757d;
            font-size: 13px;
        }

        .fs-14 {
            font-size: 14px;
        }

        .btn.btn-primary {
            width: 100%;
            height: 55px;
            border-radius: 0;
            padding: 13px 0;
            background-color: black;
            border: none;
            font-weight: 600;
        }

        .btn.btn-primary:hover .fas {
            transform: translateX(10px);
            transition: transform 0.5s ease
        }

        .fw-900 {
            font-weight: 900;
        }

        ::placeholder {
            font-size: 12px;
        }

        .ps-30 {
            padding-left: 30px;
        }

        .h4 {
            font-family: 'Work Sans', sans-serif !important;
            font-weight: 800 !important;
        }

        .textmuted,
        h5,
        .text-muted {
            font-family: 'Poppins', sans-serif;
        }

        .payment-option {
            cursor: pointer;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
            transition: background-color 0.3s;
        }

        .payment-option:hover {
            background-color: #f7f7f7;
        }
        .visa-icon {
            font-size: 20px;
            color: #1A1F71; /* Visa Blue */
        }

        .mastercard-icon {
            font-size: 20px;
            color: #FF5F00; /* MasterCard Red/Orange */
        }
        .custom-navbar .logo img {
            max-height: 20px; /* Adjust the logo size if needed */
        }
        .container{
            max-height: 20px;
        }
        .logo{
            width: 304px;
            height: auto;
        }

    </style>
</head>

<header class="d-flex align-items-center">
    <div class="container-fluid ">
        <a href="#" class="d-block">
            <img src="{{ asset('front/img/black.png') }}" alt="Logo" class="img-fluid" style="max-height: 100px; max-width: 300px;">
        </a>
    </div>
</header>


<body>




    <div class="container">
        <div class="row m-0">
            <div class="col-lg-7 pb-5 pe-lg-5">
                <div class="row">
                    <div class="col-12 p-5">
                        <img src="{{asset('storage/' . $car->car_picture)}}"
                            alt="">
                    </div>
                    <div class="row m-0 bg-light">
                        <div class="col-md-4 col-6 ps-30 pe-0 my-4">
                            <p class="text-muted">Seats</p>
                            <p class="h5">{{ $car->seats }}<span class="ps-1"></span></p>
                        </div>
                        <div class="col-md-4 col-6 ps-30 my-4">
                            <p class="text-muted">Model</p>
                            <p class="h5 m-0">{{ $car->year }}</p>
                        </div>
                        <div class="col-md-4 col-6 ps-30 my-4">
                            <p class="text-muted">Color</p>
                            <p class="h5 m-0">{{ $car->color }}</p>
                        </div>
                        <div class="col-md-4 col-6 ps-30 my-4">
                            <p class="text-muted">Rate Daily</p>
                            <p class="h5 m-0">{{ $car->price_daily }} AED</p>
                        </div>
                        <div class="col-md-4 col-6 ps-30 my-4">
                            <p class="text-muted">Rate Weekly</p>
                            <p class="h5 m-0">{{ $car->price_weekly }} AED</p>
                        </div>
                        <div class="col-md-4 col-6 ps-30 my-4">
                            <p class="text-muted">Rate Monthly</p>
                            <p class="h5 m-0">{{$car->price_monthly}} AED</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 p-0 ps-lg-4">
                <div class="row m-0">
                    <div class="col-12 px-4">
                        <div class="d-flex align-items-end mt-4 mb-2">
                            <p class="h4 m-0"><span class="pe-1">{{ $car->car_name . ' ' . $car->model . ' ' . $car->year }}</span>                            <P class="ps-3 textmuted">1L</P>
                        </div>

                        <div class="d-flex justify-content-between mb-2">
                            <p class="textmuted">Daily Price</p>
                            <p class="fs-14 fw-bold">{{$car->price_daily}} AED</p>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <p class="textmuted">Shipping</p>
                            <p class="fs-14 fw-bold">Free</p>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <p class="textmuted">Pickup Date</p>
                            <p class="fs-14 fw-bold">{{ $pickup_date }}</p>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <p class="textmuted">Return Date</p>
                            <p class="fs-14 fw-bold">{{ $return_date }}</p>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <p class="textmuted">Total Rental Days</p>
                            <p class="fs-14 fw-bold">{{ $days }} Days</p>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <p class="textmuted fw-bold">Total</p>
                            <div class="d-flex align-text-top ">
                                <span class="fas mt-1 pe-1 fs-14 "></span><span class="h4">{{ $total }} AED</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 px-4">
                        <div class="d-flex align-items-end mt-4 mb-2">
                            <p class="h4 m-0"><span class="pe-1">Customer Information</span>                            <P class="ps-3 textmuted">1L</P>
                        </div>

                        <div class="d-flex justify-content-between mb-2">
                            <p class="textmuted">Name</p>
                            <p class="fs-14 fw-bold">{{$customer_name}}</p>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <p class="textmuted">Email</p>
                            <p class="fs-14 fw-bold">{{ $customer_email }}</p>
                        </div>

                        <div class="d-flex justify-content-between mb-2">
                            <p class="textmuted">Phone Number</p>
                            <p class="fs-14 fw-bold">{{ $customer_mobile }}</p>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <p class="textmuted">Total Rental Daysr</p>
                            <p class="fs-14 fw-bold">{{ $customer_mobile }}</p>
                        </div>

                    </div>
                    <div class="col-12 px-0">
                        <div class="row bg-light m-0">
                            <div class="col-12 px-4 my-4">
                                <p class="fw-bold">Payment Methods</p>
                            </div>
                            <!-- Clickable Payment Methods -->
                            <div class="col-12 px-4 mb-3">
                            <div class="payment-option d-flex justify-content-between align-items-center" onclick="window.location.href='{{ route('stripe.payment', [
    'car' => $car->id, 
    'rate_daily' => $rate_daily, 
    'days' => $days, 
    'total' => $total,
    'pickup_date' => $pickup_date,
    'return_date' => $return_date
]) }}'">
                                    <p class="mb-0">Pay with Debit/Credit Card</p>
                                    
                                    <!-- Visa and MasterCard Icons with Right Alignment -->
                                    <div class="d-flex justify-content-end">
                                        <i class="fab fa-cc-visa visa-icon" style="font-size: 20px; margin-right: 10px;"></i>
                                        <i class="fab fa-cc-mastercard mastercard-icon" style="font-size: 20px;"></i>
                                    </div>
                                </div>
                            </div>




                            <div class="col-12 px-4 mb-3">
                                <div class="payment-option" onclick="alert('Pay with Tabby selected')" style="display: flex; justify-content: space-between; align-items: center;">
                                    <p>Pay with Tabby</p>
                                    <img src="{{ asset('front/img/icons/tabby.png') }}" alt="Tabby Logo" class="pe-2" style="width: 100px; height: 30px;">
                                </div>
                            </div>

                            <div class="col-12 px-4 mb-3">
                                <div class="payment-option" onclick="alert('Pay with Tabby selected')" style="display: flex; justify-content: space-between; align-items: center;">
                                    <p>Pay with Tabby</p>
                                    <img src="{{ asset('front/img/icons/tamara.jpeg') }}" alt="Tabby Logo" class="pe-2" style="width: 100px; height: 30px;">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
