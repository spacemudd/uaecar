@extends('front.layouts.master')
@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://unpkg.com/sweetalert/dist/sweetalert.css">


@endsection




@section('content')
<div class="preloader-bg"></div>
<div id="preloader">
    <div id="preloader-status">
        <div class="preloader-position loader"><span></span></div>
    </div>
</div>

<header class="header">
        <div class="video-fullscreen-wrap">
            <div class="video-fullscreen-video" data-overlay-dark="2">
                <video playsinline autoplay loop muted>
                    <source src="https://duruthemes.com/demo/html/renax/video.mp4" type="video/mp4">
                    <source src="https://duruthemes.com/demo/html/renax/video.webm" type="video/webm">
                </video>
            </div>
        </div>

        <style>
            .blue-icon {
                display: flex;
                align-items: center;
                }

            .icon-img {
                width: 18px; /* Adjust the size as needed */
                height: 18px; /* Maintain aspect ratio */
                margin-right: 10px; /* Space between icon and text */
            }
            @media (max-width: 600px) { /* Adjust the width as needed */
                .slogan {
                    display: none;
                }
            }

            .carousel-item img {
                max-height: 700px; /* Adjust as needed */
                object-fit: cover; /* Maintain aspect ratio and fill the area */
            }

        </style>
    </header>

<section id="cars" class="my-0 py-0">
    <div class="my-container mx-auto">
        <div class="row gy-2">
            <div class="col-lg-8">
            <div id="carCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="1000">
    <div class="carousel-inner car-box">
        <div class="carousel-item active">
            <img src="{{ asset('storage/' . $car->car_picture) }}" alt="Car Picture">

        </div>
        @foreach($images as $image)
            <div class="carousel-item">
                <img src="{{ asset('storage/' . $image->image_path) }}" class="d-block w-100" alt="Car Image">
            </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bg-dark" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon bg-dark" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>

</div>
<br>

                <h3>About the Car</h3>
                <p>{{ $car->description }}</p>
            </div>

            <div class="col-lg-4">
    <div class="card about-card"> <!-- Reduced padding -->
        <div class="card-body">
        <h1 class="fs-3">{{ $car->car_name . ' ' .  $car->model . ' ' . $car->year }}</h1>
            <p class="text-end my-0 py-0 pe-1 fw-bold fs-6">
                Daily Cost: <span class="fs-4">{{ $car->price_daily }} AED </span>
            </p>
            <div class="progress mt-1" style="height:8px;" role="progressbar" aria-label="Basic example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar w-25"></div>
            </div>
            <p class="myPar py-2 fs-6">P.S. Please note that the limit is 450 kilometers per day and 4,500 kilometers per month. Any additional kilometers will incur a charge of 1 Dirham each.</p>

            <div class="row gy-3"> <!-- Reduced vertical spacing -->
                <div class="col-6 mb-3"> <!-- Adjusted bottom margin -->
                    <div class="row align-items-center">
                        <div class="col-4">
                            <div class="blue-icon">
                                <img src="{{ asset('front/img/icons/car-seat.png') }}" alt="Seats" class="icon-img" style="width: 30px; height: 30px;" /> <!-- Decreased icon size -->
                            </div>
                        </div>
                        <div class="col-8">
                            <h5 class="small fs-6">{{ $car->seats }} Seats</h5> <!-- Decreased font size -->
                        </div>
                    </div>
                </div>

                <div class="col-6 mb-3">
                    <div class="row align-items-center">
                        <div class="col-4">
                            <div class="blue-icon">
                                <img src="{{ asset('front/img/icons/car.png') }}" alt="Doors" class="icon-img" style="width: 30px; height: 30px;" />
                            </div>
                        </div>
                        <div class="col-8">
                            <h5 class="small fs-6">{{ $car->doors }} Doors</h5>
                        </div>
                    </div>
                </div>

                <div class="col-6 mb-3">
                    <div class="row align-items-center">
                        <div class="col-4">
                            <div class="blue-icon">
                                <img src="{{ asset('front/img/icons/free-delivery.png') }}" alt="Delivery" class="icon-img" style="width: 30px; height: 30px;" />
                            </div>
                        </div>
                        <div class="col-8">
                            <h5 class="small fs-6">Free Delivery</h5>
                        </div>
                    </div>
                </div>

                <div class="col-6 mb-3">
                    <div class="row align-items-center">
                        <div class="col-4">
                            <div class="blue-icon">
                                <img src="{{ asset('front/img/icons/gear.png') }}" alt="Gear" class="icon-img" style="width: 30px; height: 30px;" />
                            </div>
                        </div>
                        <div class="col-8">
                            <h5 class="small fs-6">{{ $car->gear }}</h5>
                        </div>
                    </div>
                </div>

                <div class="col-6 mb-3">
                    <div class="row align-items-center">
                        <div class="col-4">
                            <div class="blue-icon">
                                <img src="{{ asset('front/img/icons/wallet.png') }}" alt="Daily Price" class="icon-img" style="width: 30px; height: 30px;" />
                            </div>
                        </div>
                        <div class="col-8">
                            <h5 class="small fs-6">{{ $car->price_daily }} AED Daily</h5>
                        </div>
                    </div>
                </div>

                <div class="col-6 mb-3">
                    <div class="row align-items-center">
                        <div class="col-4">
                            <div class="blue-icon">
                                <img src="{{ asset('front/img/icons/wallet.png') }}" alt="Weekly Price" class="icon-img" style="width: 30px; height: 30px;" />
                            </div>
                        </div>
                        <div class="col-8">
                            <h5 class="small fs-6">{{ number_format($car->price_weekly, 0) }} AED Weekly</h5>
                        </div>
                    </div>
                </div>

                <div class="col-6 mb-3">
                    <div class="row align-items-center">
                        <div class="col-4">
                            <div class="blue-icon">
                                <img src="{{ asset('front/img/icons/wallet.png') }}" alt="Monthly Price" class="icon-img" style="width: 30px; height: 30px;" />
                            </div>
                        </div>
                        <div class="col-8">
                            <h5 class="small fs-6">{{ number_format($car->price_monthly, 0) }} AED Monthly</h5>
                        </div>
                    </div>
                </div>

                <div class="col-6 mb-3">
                    <div class="row align-items-center">
                        <div class="col-4">
                            <div class="blue-icon">
                                <img src="{{ asset('front/img/icons/calendar.png') }}" alt="Year" class="icon-img" style="width: 30px; height: 30px;" />
                            </div>
                        </div>
                        <div class="col-8">
                            <h5 class="small fs-6">{{ $car->year }}</h5>
                        </div>
                    </div>
                </div>

                <div class="col-6 mb-3">
                    <div class="row align-items-center">
                        <div class="col-4">
                            <div class="blue-icon">
                                <img src="{{ asset('front/img/icons/mileage.png') }}" alt="kilo_daily" class="icon-img" style="width: 30px; height: 30px;" />
                            </div>
                        </div>
                        <div class="col-8">
                            <h5 class="small fs-6">4,500/km Monthly</h5>
                        </div>
                    </div>
                </div>

                <div class="col-6 mb-3">
                    <div class="row align-items-center">
                        <div class="col-4">
                            <div class="blue-icon">
                                <img src="{{ asset('front/img/icons/mileage.png') }}" alt="kilo_monthly" class="icon-img" style="width: 30px; height: 30px;" />
                            </div>
                        </div>
                        <div class="col-8">
                            <h5 class="small fs-6">450/km Daily</h5>
                        </div>
                    </div>
                </div>


                <div class="col-6 mb-3">
                    <div class="row align-items-center">
                        <div class="col-4">
                            <div class="blue-icon">
                                <img src="{{ asset('front/img/icons/color-wheel.png') }}" alt="color" class="icon-img" style="width: 30px; height: 30px;" />
                            </div>
                        </div>
                        <div class="col-8">
                            <h5 class="small fs-6">{{ $car->color }}</h5>
                        </div>
                    </div>
                </div>


                <div class="col-6 mb-3">
                    <div class="row align-items-center">
                        <div class="col-4">
                            <div class="blue-icon">
                                <img src="{{ asset('front/img/icons/signal.png') }}" alt="color" class="icon-img" style="width: 30px; height: 30px;" />
                            </div>
                        </div>
                        <div class="col-8">
                            <h5 class="small fs-6">{{ $car->categories }}</h5>
                        </div>
                    </div>
                </div>
                @php
    $carName = urlencode($car->car_name); // URL encode the car name
    $carPicture = asset('storage/' . $car->car_picture); // URL of the car picture
    $message = "Hello, I am interested in the car: $carName. Here is the picture: $carPicture";
    $whatsappLink = "https://api.whatsapp.com/send?phone=971542700030&text=" . urlencode($message);
@endphp

<div class="btn-double mt-30" data-grouptype="&amp;">
    <a data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo" href="#0">Rent Now</a>
    <a href="{{ $whatsappLink }}" target="_blank"><span class="fa-brands fa-whatsapp"></span> WhatsApp</a>
</div>


            </div>
        </div>
    </div>
</div>




                        <!-- <div class="text-center my-3">
                            <img src="{{asset('public/front/img/icons/apple-pay.png')}}" alt="Visa" class="img-fluid" style="height: 40px; margin-right: 10px;">
                            <img src="{{asset('public/front/img/icons/visa.png')}}" alt="MasterCard" class="img-fluid" style="height: 40px;">
                            <img src="{{asset('public/front/img/icons/visa.png')}}" alt="MasterCard" class="img-fluid" style="height: 40px;">

                        </div> -->
                        
                        </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Booking Form for {{ $car->car_name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="booking-box">
                    <div class="booking-inner clearfix">
                        <form method="post" action="{{ route('form.submit') }}" class="form1 contact__form clearfix">
                            @csrf
                            <input type="hidden" name="car_id" value="{{ $car->id }}">
                            <div class="row">
                                <div class="col-12">
                                    <div class="alert alert-success contact__msg" style="display: none" role="alert"> Your message was sent successfully. </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <label>Car Name</label>
                                    <input name="carName" type="text" class="form-control" value="{{ $car->car_name }}" readonly>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <label>Car ID</label>
                                    <input type="text" class="form-control" value="{{ $car->id }}" name="carID" readonly>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <input name="name" type="text" placeholder="Full Name *" required>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <input name="email" type="email" placeholder="Email *" required>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <input name="phone" type="text" placeholder="Phone *" required>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="select1_wrapper">
                                        <label>Pick Up Location</label>
                                        <div class="select1_inner">
                                            <select name="pickup_city" class="select2 select" style="width: 100%" required>
                                                <option value="" disabled selected>Select a City</option>
                                                <option value="Dubai">Dubai</option>
                                                <option value="Abu Dhabi">Abu Dhabi</option>
                                                <option value="Sharjah">Sharjah</option>
                                                <option value="Al Ain">Al Ain</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="input1_wrapper">
                                        <label>Pick Up Date</label>
                                        <div class="input1_inner">
                                            <input name="pickup_date" type="text" class="form-control input datepicker" placeholder="Pick Up Date" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="input1_wrapper">
                                        <label>Return Date</label>
                                        <div class="input1_inner">
                                            <input name="return_date" type="text" class="form-control input datepicker" placeholder="Return Date" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 form-group">
                                    <textarea name="message" id="message" cols="30" rows="4" placeholder="Additional Note"></textarea>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <input type="hidden" name="daily_car_price" value="{{ $car->price_daily }}">
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <button type="submit" class="booking-button mt-15">Rent Now</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
