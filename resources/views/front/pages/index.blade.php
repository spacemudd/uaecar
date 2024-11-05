@extends('front.layouts.master')

<link rel="stylesheet" href="https://unpkg.com/sweetalert/dist/sweetalert.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>



@section('content')
    <!-- Preloader -->
    <div class="preloader-bg"></div>
    <div id="preloader">
        <div id="preloader-status">
            <div class="preloader-position loader"><span></span></div>
        </div>
    </div>

    <!-- Header Video -->
    <header class="header">
        <div class="video-fullscreen-wrap">
            
            <div class="video-fullscreen-video" data-overlay-dark="2">
                <video playsinline autoplay loop muted>
                    <source src="https://duruthemes.com/demo/html/renax/video.mp4" type="video/mp4">
                    <source src="https://duruthemes.com/demo/html/renax/video.webm" type="video/webm">
                </video>
            </div>
            <div class="slogan-container">
            <h3 class="slogan-image">The Right Car For Every Road - Rent Your Way</h3>
        </div>
           
        </div>




        <style>
        .header {
            position: relative;
            overflow: hidden;
            height: 33vh; /* Adjust height as needed */
        }

        .video-fullscreen-wrap {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .video-fullscreen-video {
            min-width: 100%;
            min-height: 100%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 0; /* Send video behind header */
        }

        .slogan-container {
            position: absolute;
            top: 60%;
            right: 11%; /* Position it 20px from the right */
            transform: translateY(-50%); /* Center vertically */
            z-index: 1; /* Ensure the slogan is above the video */
            text-align: center; /* Center the slogan */
        }

        .slogan-image {
            max-width: 100%; /* Responsive image */
            height: auto;
            color: white;
            font-weight: 50;
            font-size: 25px;
        }

        @media (max-width: 768px) {
        .slogan-image {
            display: none; /* Hide image on small screens */
        }
        .slogan-text {
            display: block; /* Show alternative text */
            text-align: center; /* Center text */
        }

        
    }


    @media (max-width: 480px) {
        .slogan-image {
            display: none; /* Hide image on small screens */
        }
        .slogan-text {
            display: block; /* Show alternative text */
            text-align: center; /* Center text */
        }

        
    }
    </style>
    </header>

    <!-- Clients Section -->
    <section class="clients mt-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="owl-carousel owl-theme">
                        @foreach(range(1, 11) as $i)
                            <div class="clients-logo">
                                <a href="#0"><img src="{{ asset('front/img/clients/' . $i . '.png') }}" alt=""></a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Cars Section -->
<section class="cars2 section-padding my-0 py-0 px-3 mx-auto">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Our Cars</h2><br>
                    <p>Choose the car that fits your needs</p>
                </div>
            </div>

        <div class="row gy-2">
            @foreach($cars as $car)
                <!-- Car Card -->
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-3 " style="text-decoration: none;">
                    <div class="card3 w-100">
                    <span class="px-4 py-3" style="display: inline-block;">
                        <h3 class="car_name" style="display: inline-block; margin: 0; font-size: 20px;">{{ $car->car_name . ' ' . $car->model}}</h3>
                        <br>
                        <h4 class="car_name" style="display:inline-block; margin:0;">{{ $car->year }}</h4>
                    </span>
                    <div class="span-group px-3" style="font-size: 12px;">
                        <span>{{ $car->seats . ' Seats' }}</span>
                        <span>{{ $car->doors . ' Doors' }}</span>
                        <span>Automatic</span>
                    </div>
                    <a href="{{ route('cars.show', $car->id) }}">

                    <div>
                        <img src="{{ asset('storage/' . $car->car_picture) }}" alt="Car Picture">
                    </div>
                    </a>
                    <div class="row mb-5 gx-2 justify-content-center">
                        <div class="col-4">
                            <h4 class="text-center text-white">Daily</h4>
                            <h6 class="text-center text-white fw-light">{{ $car->price_daily }} <span>AED</span></h6>
                        </div>

                        <div class="col-4">
                            <h4 class="text-center text-white">Weekly</h4>
                            <h6 class="text-center text-white fw-light">{{ $car->price_weekly }} <span>AED</span></h6>
                        </div>

                        <div class="col-4">
                            <h4 class="text-center text-white">Monthly</h4>
                            <h6 class="text-center text-white fw-light">{{ $car->price_monthly }} <span>AED</span></h6>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3 d-flex justify-center">
                                    <button class="btn mx-auto text-center my-2" style="background-color: #949494; color: white;" data-bs-toggle="modal" data-bs-target="#bookingModal{{ $car->id }}">
                                        Book Now
                                    </button>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="mb-3 d-flex justify-center">
                                    <button class="btn btn-success mx-auto text-center my-2" style="background-color: #128c7e;">
                                        <i class="fab fa-whatsapp"></i> WhatsApp
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
               
                    </div>
                <!-- Booking Modal -->
                <div class="modal fade" id="bookingModal{{ $car->id }}" tabindex="-1" aria-labelledby="bookingModalLabel{{ $car->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="bookingModalLabel{{ $car->id }}">Booking Form for {{ $car->car_name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="booking-box">
                                    <div class="booking-inner clearfix">
                                        <form method="post" action="{{ route('form.submit') }}" class="form1 contact__form clearfix" id="bookingForm">
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
                                                                <option value="Alain">Alain</option>
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
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>


@endsection
