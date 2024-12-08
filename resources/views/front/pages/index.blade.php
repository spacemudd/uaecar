@extends('front.layouts.master')


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/owl.carousel.min.js"></script>
<script async src="//www.instagram.com/embed.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('node_error_message'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Error!',
                text: "Please Try again later",
                confirmButtonText: 'OK'
            });
        });
    </script>
@endif



@if (session('error_message'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'This Car Is Currently Booked',
                html: `
                    <p style="color:red;">{{ session('error_message') }}</p>
                    <img src="{{ session('car_picture') }}" alt="Selected Car" class="car-image" style="max-width: 50%; height: auto; margin-top: 10px;">

                    <div class="mt-4">
                        <h5>Recommended Cars</h5>
                        <div class="row">
                           <div class="col-4 text-center">
                                <a href="{{ route('cars.show', ['id' => session('car-0-id')]) }}" style="text-decoration: none; color: inherit;">
                                    <img src="{{ asset('storage/' . session('car-0-image')) }}" alt="Car 1" class="img-fluid" style="max-width: 70%; height: auto; margin-bottom: 10px;">
                                    <h6>{{ session('car-0-name') . ' ' . session('car-0-model') }}</h6>
                                    <p>{{ session('car-0-price') }} AED</p>
                                </a>
                            </div>

                            <!-- Car 2 -->
                            <div class="col-4 text-center">
                                <a href="{{ route('cars.show', ['id' => session('car-1-id')]) }}" style="text-decoration: none; color: inherit;">
                                    <img src="{{ asset('storage/' . session('car-1-image')) }}" alt="Car 2" class="img-fluid" style="max-width: 70%; height: auto; margin-bottom: 10px;">
                                    <h6>{{ session('car-1-name') . ' ' . session('car-1-model') }}</h6>
                                    <p>{{ session('car-1-price') }} AED</p>
                                </a>
                            </div>


                            <!-- Car 3 -->
                            <div class="col-4 text-center">
                                <a href="{{ route('cars.show', ['id' => session('car-2-id')]) }}" style="text-decoration: none; color: inherit;">
                                    <img src="{{ asset('storage/' . session('car-2-image')) }}" alt="Car 3" class="img-fluid" style="max-width: 70%; height: auto; margin-bottom: 10px;">
                                    <h6>{{ session('car-2-name') . ' ' . session('car-2-model') }}</h6>
                                    <p>{{ session('car-2-price') }} AED</p>
                                </a>
                            </div>

                        </div>
                    </div>
                `,
                confirmButtonText: 'OK',
                width: '800px', // Increase width to accommodate all content
                customClass: {
                    popup: 'swal-popup-custom'
                }
            });
        });
    </script>

@endif





<style>


                .ui-datepicker .ui-state-disabled {
                    color: #b0b0b0; /* Gray color */
                    background-color: #f0f0f0; /* Light gray background */
                    border: 1px solid #d0d0d0; /* Light gray border */
                    cursor: not-allowed; /* Change cursor to indicate the date is disabled */
                }

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
                        right: 15%;
                        transform: translateY(-50%);
                        z-index: 1;
                        text-align: center;
                        }


                        .slogan-image {
                            max-width: 100%;
                            height: auto;
                            color: white;
                            font-weight: 50;
                            font-size: 18px;
                            margin-right: 0;
                            }

                @media (max-width: 768px) {

                .slogan-text {
                    display: block; /* Show alternative text */
                    text-align: center; /* Center text */
                }

                
            }


            @media (max-width: 480px) {
              

                .slogan-image {
                    max-width: 100%; /* Responsive image */
                    height: auto;
                    color: white;
                    font-weight: 50;
                    font-size: 15px;
                    text-align: center;
                }
            
                .slogan-text {
                    font-size: 20px;
                    text-align: center; /* Center text */
                }

                
            }

</style>

<script>
    $(document).ready(function(){
        $(".owl-carousel").owlCarousel({
            loop: true,                     // Enable continuous loop
            margin: 10,                     // Adjust margin between items
            nav: false,                     // Disable navigation buttons
            dots: false,                    // Hide pagination dots
            autoplay: true,                 // Enable autoplay
            autoplayTimeout: 1000,          // Time between slides (1 second)
            autoplayHoverPause: true,       // Pause on hover
            autoplaySpeed: 2000,             // Speed of transition between slides
            responsive: {
                0: {
                    items: 5             // 1 item on small screens
                },
                600: {
                    items: 3              // 3 items on medium screens
                },
                1000: {
                    items: 5              // 5 items on large screens
                }
            }
        });
    });

    $(document).ready(function(){
        $('.datepicker').datepicker({
            minDate: 0  // This ensures the user can only select today's date or any future date
        });
    });
    document.addEventListener('DOMContentLoaded', function() {
            flatpickr("#pickup_date", {
                enableTime: true,
                dateFormat: "Y-m-d H:i:S", // Sets the format to match the API requirement
                time_24hr: true,
                minDate: "today",
            });

            flatpickr("#return_date", {
                enableTime: true,
                dateFormat: "Y-m-d H:i:S",
                time_24hr: true,
                minDate: "today",
            });
        });
</script>


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
                <h3 class="slogan-image" style="font-family: 'Calisto MT', serif;">The Right Car For Every Road - Rent Your Way</h3>
            </div>
        </div>
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

<!-- 
    <div class="text-center">
    <img src="{{ asset('front/img/Web_Banners_7.png') }}" alt="Banner Image" class="img-fluid" style="max-width: 1200px;"> 
</div>
 -->

<!-- Initialize Owl Carousel with your custom settings -->


        <!-- Luxury Cars Section -->
        <section class="cars2 section-padding my-0 py-0 px-3 mx-auto py-5 mt-5">
        
            <div class="row mt-4">
                <div class="col-12 position-relative d-flex justify-content-center align-items-center" style="background-color: black; width: 100vw;">
                    <!-- Centered Title -->
                    <div id="text-container">
                        <div id="line-one">
                            <h1 class="display-3 mb-4" style="color:white;">LUXURY</h1>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Adjusting the row for luxury cars -->
            <div class="row gy-2 mt-4" style="background-color: white;">
    <!-- Loop through luxury cars only -->
    @foreach($cars as $car)
        @if(strtolower($car->categories) === 'luxury')  <!-- Filter only luxury cars -->
            <!-- Car Card -->
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-3" style="text-decoration: none;">
                <div class="card3 w-100">
                    <span class="px-4 py-3" style="display: inline-block;">
                        <h3 class="car_name" style="display: inline-block; margin: 0; font-size: 23px; font-family: 'Calisto MT', serif;">{{ $car->car_name . ' ' . $car->model}}</h3>
                        <br>
                        <h4 class="car_name" style="display:inline-block; margin:0; font-family: 'Calisto MT', serif;">{{ $car->year }}</h4>
                    </span>
                    <div class="span-group px-3 fw-bold" style="font-size: 12px; font-family: 'Calisto MT', serif;">
                        <span>{{ $car->seats . ' Seats' }}</span>
                        <span>{{ $car->doors . ' Doors' }}</span>
                        <span>Automatic</span>
                        <span style="background-color: #1B1B1B; color: white;">LUXURY</span>
                    </div>
                    <a href="{{ route('cars.show', $car->id) }}">
                        <div>
                            <img src="{{ asset('storage/' . $car->car_picture) }}" alt="Car Picture">
                        </div>
                    </a>
                    <div class="row mb-5 gx-2 justify-content-center">
                        <div class="col-4">
                            <h4 class="text-center text-white" style="font-family: 'Calisto MT', serif; font-size:medium;">Daily</h4>
                            <h6 class="text-center text-white fw-bold" style="font-family: 'Calisto MT', serif; font-size:large;">{{ $car->price_daily }} <span>AED</span></h6>
                        </div>
                        <div class="col-4">
                            <h4 class="text-center text-white" style="font-family: 'Calisto MT', serif; font-size:medium;">Weekly</h4>
                            <h6 class="text-center text-white fw-bold" style="font-family: 'Calisto MT', serif; font-size:large;">{{ $car->price_weekly }} <span>AED</span></h6>
                        </div>
                        <div class="col-4">
                            <h4 class="text-center text-white" style="font-family: 'Calisto MT', serif; font-size:medium;">Monthly</h4>
                            <h6 class="text-center text-white fw-bold" style="font-family: 'Calisto MT', serif; font-size:large;">{{ $car->price_monthly }} <span>AED</span></h6>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3 d-flex justify-content-start">
                                    <button class="btn text-center my-2" style="background-color: #949494; color: white; font-family: 'Calisto MT', serif;" data-bs-toggle="modal" data-bs-target="#bookingModal{{ $car->id }}">
                                        Book Now
                                    </button>
                                </div>
                            </div>
                            <div class="col-6 position-relative">
                                <div class="mb-3">
                                    <!-- WhatsApp Icon as a clickable link -->
                                    <a href="https://wa.me/971542700030?text=Hi!%20I%20am%20interested%20in%20this%20car.%20Here%20is%20the%20link%20to%20the%20car:%20{{ route('cars.show', ['id' => $car->id]) }}%20and%20here%20is%20the%20image%20of%20the%20car:%20{{ asset('path/to/car-image.jpg') }}" target="_blank" class="position-absolute bottom-0 end-0 mb-4 me-3">
                                        <i class="fab fa-whatsapp" style="font-size: 40px; color: #25D366;"></i> <!-- Larger WhatsApp icon -->
                                    </a>
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
                                        <input type="hidden" name="car_picture" value="{{ asset('storage/' . $car->car_picture) }}"> <!-- Hidden input for the car picture -->
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="alert alert-success contact__msg" style="display: none" role="alert"> Your message was sent successfully. </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-12">
                                                <label>Car Name</label>
                                                <input name="carName" type="text" class="form-control" value="{{ $car->car_name . ' ' . $car->model . ' ' . $car->year }}" readonly>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <label>Car ID</label>
                                                <input type="text" class="form-control" value="{{ $car->id }}" name="carID" readonly>
                                            </div>
                                            <input type="hidden" name="plate_number" value="{{ $car->plate_number }}">
                                            <input type="hidden" name="price_daily" value="{{ $car->price_daily }}">
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
                                                            <option value="Sharjah">Sharjah</option>
                                                            <option value="Alain">Alain</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="input1_wrapper">
                                                    <label>Pick Up Date and Time</label>
                                                    <div class="input1_inner">
                                                        <input id="pickup_date" name="pickup_date" type="text" class="form-control input" placeholder="Pick Up Date and Time" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="input1_wrapper">
                                                    <label>Return Up Date and Time</label>
                                                    <div class="input1_inner">
                                                        <input id="return_date" name="return_date" type="text" class="form-control input" placeholder="Return Up Date and Time" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 form-group">
                                                <textarea name="message" id="message" cols="30" rows="4" placeholder="Additional Note"></textarea>
                                            </div>

                                            <div class="col-lg-12 col-md-12">
                                                <input type="hidden" name="daily_car_price" value="{{ $car->price_daily }}">
                                                <button type="submit" class="btn contact__btn">Submit</button>
                                            </div>
                                             
                                             
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</div>

        </section>




        <!-- Mid Range Section -->
        <section class="cars2 section-padding my-0 py-0 px-3 mx-auto py-5 mt-5">
            <div class="row mt-4">
                <div class="col-12 position-relative d-flex justify-content-center align-items-center" style="background-color: black; width: 100vw;">
                    <div id="text-container">
                        <div id="line-one">
                            <h1 class="display-3" style="color: white;">Mid Range</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row gy-2">
                @foreach($cars as $car)
                    @if(strtolower($car->categories) == 'mid range') <!-- Check if category is 'mid range' -->
                        <!-- Car Card -->
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-3" style="text-decoration: none;">
                            <div class="card3 w-100">
                                <span class="px-4 py-3" style="display: inline-block;">
                                    <h3 class="car_name" style="display: inline-block; margin: 0; font-size: 23px; font-family: 'Calisto MT', serif;">{{ $car->car_name . ' ' . $car->model }}</h3>
                                    <br>
                                    <h4 class="car_name" style="display:inline-block; margin:0; font-family: 'Calisto MT', serif;">{{ $car->year }}</h4>
                                </span>
                                <div class="span-group px-3 fw-bold" style="font-size: 12px; font-family: 'Calisto MT', serif;">
                                    <span>{{ $car->seats . ' Seats' }}</span>
                                    <span>{{ $car->doors . ' Doors' }}</span>
                                    <span>Automatic</span>
                                    <span style="background-color: green;">
                                        {{ $car->categories }}
                                    </span>
                                </div>
                                <a href="{{ route('cars.show', $car->id) }}">
                                    <div>
                                        <img src="{{ asset('storage/' . $car->car_picture) }}" alt="Car Picture">
                                    </div>
                                </a>
                                <div class="row mb-5 gx-2 justify-content-center">
                                    <div class="col-4">
                                        <h4 class="text-center text-white" style="font-family: 'Calisto MT', serif; font-size:medium;">Daily</h4>
                                        <h6 class="text-center text-white fw-bold" style="font-family: 'Calisto MT', serif; font-size:large;">{{ $car->price_daily }} <span>AED</span></h6>
                                    </div>

                                    <div class="col-4">
                                        <h4 class="text-center text-white" style="font-family: 'Calisto MT', serif; font-size:medium;">Weekly</h4>
                                        <h6 class="text-center text-white fw-bold" style="font-family: 'Calisto MT', serif; font-size:large;">{{ $car->price_weekly }} <span>AED</span></h6>
                                    </div>

                                    <div class="col-4">
                                        <h4 class="text-center text-white" style="font-family: 'Calisto MT', serif; font-size:medium;">Monthly</h4>
                                        <h6 class="text-center text-white fw-bold" style="font-family: 'Calisto MT', serif; font-size:large;">{{ $car->price_monthly }} <span>AED</span></h6>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mb-3 d-flex justify-content-start">
                                                <button class="btn text-center my-2" style="background-color: #949494; color: white; font-family: 'Calisto MT', serif;" data-bs-toggle="modal" data-bs-target="#bookingModal{{ $car->id }}">
                                                    Book Now
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-6 position-relative">
                                            <div class="mb-3">
                                                <!-- WhatsApp Icon as a clickable link -->
                                                <a href="https://wa.me/971542700030?text=Hi!%20I%20am%20interested%20in%20this%20car.%20Here%20is%20the%20link%20to%20the%20car:%20{{ route('cars.show', ['id' => $car->id]) }}%20and%20here%20is%20the%20image%20of%20the%20car:%20{{ asset('path/to/car-image.jpg') }}" target="_blank" class="position-absolute bottom-0 end-0 mb-4 me-3">
                                                    <i class="fab fa-whatsapp" style="font-size: 40px; color: #25D366;"></i> <!-- Larger WhatsApp icon -->
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                            <input type="hidden" name="car_picture" value="{{ asset('storage/' . $car->car_picture) }}"> <!-- Hidden input for the car picture -->

                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="alert alert-success contact__msg" style="display: none" role="alert"> Your message was sent successfully. </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-12">
                                                    <label>Car Name</label>
                                                    <input name="carName" type="text" class="form-control" value="{{ $car->car_name . ' ' . $car->model . ' ' . $car->year }}" readonly>
                                                </div>
                                                <div class="col-lg-6 col-md-12">
                                                    <label>Car ID</label>
                                                    <input type="text" class="form-control" value="{{ $car->id }}" name="carID" readonly>
                                                </div>
                                                <input type="hidden" name="plate_number" value="{{ $car->plate_number }}">
                                                <input type="hidden" name="price_daily" value="{{ $car->price_daily }}">


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
                                                                <option value="Sharjah">Sharjah</option>
                                                                <option value="Alain">Alain</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="input1_wrapper">
                                                        <label>Pick Up Date and Time</label>
                                                        <div class="input1_inner">
                                                            <input id="pickup_date" name="pickup_date" type="text" class="form-control input" placeholder="Pick Up Date and Time" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-12">
                                                    <div class="input1_wrapper">
                                                        <label>Return Up Date and Time</label>
                                                        <div class="input1_inner">
                                                            <input id="return_date" name="return_date" type="text" class="form-control input" placeholder="Return Up Date and Time" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 form-group">
                                                <textarea name="message" id="message" cols="30" rows="4" placeholder="Additional Note"></textarea>
                                            </div>

                                            <div class="col-lg-12 col-md-12">
                                                <input type="hidden" name="daily_car_price" value="{{ $car->price_daily }}">
                                                <button type="submit" class="btn contact__btn">Submit</button>
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
                    @endif
                @endforeach
            </div>
        </section>



       <!-- Economy Section -->
        <section class="cars2 section-padding my-0 py-0 px-3 mx-auto py-5 mt-5">
            <div class="row mt-4">
                <div class="col-12 position-relative d-flex justify-content-center align-items-center" style="background-color: black; width: 100vw;">
                    <div id="text-container">
                        <div id="line-one">
                            <h1 class="display-3" style="color: white;">Economy</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row gy-2">
                @foreach($cars as $car)
                    @if(strtolower($car->categories) == 'economy') <!-- Check if category is 'economy' -->
                        <!-- Car Card -->
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-3" style="text-decoration: none;">
                            <div class="card3 w-100">
                                <span class="px-4 py-3" style="display: inline-block;">
                                    <h3 class="car_name" style="display: inline-block; margin: 0; font-size: 23px; font-family: 'Calisto MT', serif;">{{ $car->car_name . ' ' . $car->model }}</h3>
                                    <br>
                                    <h4 class="car_name" style="display: inline-block; margin: 0; font-family: 'Calisto MT', serif;">{{ $car->year }}</h4>
                                </span>
                                <div class="span-group px-3 fw-bold" style="font-size: 12px; font-family: 'Calisto MT', serif;">
                                    <span>{{ $car->seats . ' Seats' }}</span>
                                    <span>{{ $car->doors . ' Doors' }}</span>
                                    <span>Automatic</span>
                                    <span style="background-color: orange;">
                                        {{ $car->categories }}
                                    </span>
                                </div>
                                <a href="{{ route('cars.show', $car->id) }}">
                                    <div>
                                        <img src="{{ asset('storage/' . $car->car_picture) }}" alt="Car Picture">
                                    </div>
                                </a>
                                <div class="row mb-5 gx-2 justify-content-center">
                                    <div class="col-4">
                                        <h4 class="text-center text-white" style="font-family: 'Calisto MT', serif; font-size: medium;">Daily</h4>
                                        <h6 class="text-center text-white fw-bold" style="font-family: 'Calisto MT', serif; font-size: large;">{{ $car->price_daily }} <span>AED</span></h6>
                                    </div>

                                    <div class="col-4">
                                        <h4 class="text-center text-white" style="font-family: 'Calisto MT', serif; font-size: medium;">Weekly</h4>
                                        <h6 class="text-center text-white fw-bold" style="font-family: 'Calisto MT', serif; font-size: large;">{{ $car->price_weekly }} <span>AED</span></h6>
                                    </div>

                                    <div class="col-4">
                                        <h4 class="text-center text-white" style="font-family: 'Calisto MT', serif; font-size: medium;">Monthly</h4>
                                        <h6 class="text-center text-white fw-bold" style="font-family: 'Calisto MT', serif; font-size: large;">{{ $car->price_monthly }} <span>AED</span></h6>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mb-3 d-flex justify-content-start">
                                                <button class="btn text-center my-2" style="background-color: #949494; color: white; font-family: 'Calisto MT', serif;" data-bs-toggle="modal" data-bs-target="#bookingModal{{ $car->id }}">
                                                    Book Now
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-6 position-relative">
                                            <div class="mb-3">
                                                <!-- WhatsApp Icon as a clickable link -->
                                                <a href="https://wa.me/971542700030?text=Hi!%20I%20am%20interested%20in%20this%20car.%20Here%20is%20the%20link%20to%20the%20car:%20{{ route('cars.show', ['id' => $car->id]) }}%20and%20here%20is%20the%20image%20of%20the%20car:%20{{ asset('path/to/car-image.jpg') }}" target="_blank" class="position-absolute bottom-0 end-0 mb-4 me-3">
                                                    <i class="fab fa-whatsapp" style="font-size: 40px; color: #25D366;"></i> <!-- Larger WhatsApp icon -->
                                                </a>
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
                                            <input type="hidden" name="car_picture" value="{{ asset('storage/' . $car->car_picture) }}"> <!-- Hidden input for the car picture -->

                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="alert alert-success contact__msg" style="display: none" role="alert"> Your message was sent successfully. </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-12">
                                                    <label>Car Name</label>
                                                    <input name="carName" type="text" class="form-control" value="{{ $car->car_name . ' ' . $car->model . ' ' . $car->year }}" readonly>
                                                </div>
                                                <div class="col-lg-6 col-md-12">
                                                    <label>Car ID</label>
                                                    <input type="text" class="form-control" value="{{ $car->id }}" name="carID" readonly>
                                                </div>
                                                <input type="hidden" name="plate_number" value="{{ $car->plate_number }}">
                                                <input type="hidden" name="price_daily" value="{{ $car->price_daily }}">


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
                                                                <option value="Sharjah">Sharjah</option>
                                                                <option value="Alain">Alain</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="input1_wrapper">
                                                        <label>Pick Up Date and Time</label>
                                                        <div class="input1_inner">
                                                            <input id="pickup_date" name="pickup_date" type="text" class="form-control input" placeholder="Pick Up Date and Time" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-12">
                                                    <div class="input1_wrapper">
                                                        <label>Return Up Date and Time</label>
                                                        <div class="input1_inner">
                                                            <input id="return_date" name="return_date" type="text" class="form-control input" placeholder="Return Up Date and Time" required>
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
                        <!-- End Booking Modal -->
                    @endif
                @endforeach
            </div>
        </section>


        <!-- Sport Section -->
        <section class="cars2 section-padding my-0 py-0 px-3 mx-auto py-5 mt-5">
            <div class="row mt-4">
                <div class="col-12 position-relative d-flex justify-content-center align-items-center" style="background-color: black; width: 100vw;">
                    <div id="text-container">
                        <div id="line-one">
                            <h1 class="display-3" style="color: white;">
                                Sports and Exotics
                            </h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row gy-2">
                @foreach($cars as $car)
                    @if(strtolower($car->categories) == 'sports and exotics')
                        <!-- Car Card -->
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-3" style="text-decoration: none;">
                            <div class="card3 w-100">
                                <span class="px-4 py-3" style="display: inline-block;">
                                    <h3 class="car_name" style="display: inline-block; margin: 0; font-size: 23px; font-family: 'Calisto MT', serif;">{{ $car->car_name . ' ' . $car->model }}</h3>
                                    <br>
                                    <h4 class="car_name" style="display:inline-block; margin:0; font-family: 'Calisto MT', serif;">{{ $car->year }}</h4>
                                </span>
                                <div class="span-group px-3 fw-bold" style="font-size: 12px; font-family: 'Calisto MT', serif;">
                                    <span>{{ $car->seats . ' Seats' }}</span>
                                    <span>{{ $car->doors . ' Doors' }}</span>
                                    <span>Automatic</span>
                                    <span style="background-color: blue;">
                                        Sports
                                    </span>
                                </div>

                                <a href="{{ route('cars.show', $car->id) }}">
                                    <div>
                                        <img src="{{ asset('storage/' . $car->car_picture) }}" alt="Car Picture">
                                    </div>
                                </a>

                                <div class="row mb-5 gx-2 justify-content-center">
                                    <div class="col-4">
                                        <h4 class="text-center text-white" style="font-family: 'Calisto MT', serif; font-size:medium;">Daily</h4>
                                        <h6 class="text-center text-white fw-bold" style="font-family: 'Calisto MT', serif; font-size:large;">{{ $car->price_daily }} <span>AED</span></h6>
                                    </div>

                                    <div class="col-4">
                                        <h4 class="text-center text-white" style="font-family: 'Calisto MT', serif; font-size:medium;">Weekly</h4>
                                        <h6 class="text-center text-white fw-bold" style="font-family: 'Calisto MT', serif; font-size:large;">{{ $car->price_weekly }} <span>AED</span></h6>
                                    </div>

                                    <div class="col-4">
                                        <h4 class="text-center text-white" style="font-family: 'Calisto MT', serif; font-size:medium;">Monthly</h4>
                                        <h6 class="text-center text-white fw-bold" style="font-family: 'Calisto MT', serif; font-size:large;">{{ $car->price_monthly }} <span>AED</span></h6>
                                    </div>

                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mb-3 d-flex justify-content-start">
                                                <button class="btn text-center my-2" style="background-color: #949494; color: white; font-family: 'Calisto MT', serif;" data-bs-toggle="modal" data-bs-target="#bookingModal{{ $car->id }}">
                                                    Book Now
                                                </button>
                                            </div>
                                        </div>

                                        <div class="col-6 position-relative">
                                            <div class="mb-3">
                                                <!-- WhatsApp Icon as a clickable link -->
                                                <a href="https://wa.me/971542700030?text=Hi!%20I%20am%20interested%20in%20this%20car.%20Here%20is%20the%20link%20to%20the%20car:%20{{ route('cars.show', ['id' => $car->id]) }}%20and%20here%20is%20the%20image%20of%20the%20car:%20{{ asset('storage/' . $car->car_picture) }}" target="_blank" class="position-absolute bottom-0 end-0 mb-4 me-3">
                                                    <i class="fab fa-whatsapp" style="font-size: 40px; color: #25D366;"></i> <!-- Larger WhatsApp icon -->
                                                </a>
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
                                            <input type="hidden" name="car_picture" value="{{ asset('storage/' . $car->car_picture) }}"> <!-- Hidden input for the car picture -->

                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="alert alert-success contact__msg" style="display: none" role="alert"> Your message was sent successfully. </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-12">
                                                    <label>Car Name</label>
                                                    <input name="carName" type="text" class="form-control" value="{{ $car->car_name . ' ' . $car->model . ' ' . $car->year }}" readonly>
                                                </div>
                                                <div class="col-lg-6 col-md-12">
                                                    <label>Car ID</label>
                                                    <input type="text" class="form-control" value="{{ $car->id }}" name="carID" readonly>
                                                </div>
                                                <input type="hidden" name="plate_number" value="{{ $car->plate_number }}">
                                                <input type="hidden" name="price_daily" value="{{ $car->price_daily }}">


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
                                                                <option value="Sharjah">Sharjah</option>
                                                                <option value="Alain">Alain</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="input1_wrapper">
                                                        <label>Pick Up Date and Time</label>
                                                        <div class="input1_inner">
                                                            <input id="pickup_date" name="pickup_date" type="text" class="form-control input" placeholder="Pick Up Date and Time" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-12">
                                                    <div class="input1_wrapper">
                                                        <label>Return Up Date and Time</label>
                                                        <div class="input1_inner">
                                                            <input id="return_date" name="return_date" type="text" class="form-control input" placeholder="Return Up Date and Time" required>
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
                        <!-- End Booking Modal -->
                    @endif
                @endforeach
            </div>
        </section>


        <section class="cars2 section-padding my-0 py-0 px-3 mx-auto py-5 mt-5">
            <div class="row mt-4">
                <div class="col-12 position-relative d-flex justify-content-center align-items-center" style="background-color: black; width: 100vw;">
                    <div id="text-container" class="mt-4 mb-4">
                        <div id="line-one">
                            <h1 class="display-3" style="color: white;">
                                Vans and Buses
                            </h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row gy-2 mt-4">
                @foreach($cars as $car)
                    @if(strtolower($car->categories) == 'vans and buses')
                        <!-- Car Card -->
                        <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-3" style="text-decoration: none;">
                            <div class="card3 w-100">
                                <span class="px-4 py-3" style="display: inline-block;">
                                    <h3 class="car_name" style="display: inline-block; margin: 0; font-size: 23px; font-family: 'Calisto MT', serif;">{{ $car->car_name . ' ' . $car->model }}</h3>
                                    <br>
                                    <h4 class="car_name" style="display: inline-block; margin: 0; font-family: 'Calisto MT', serif;">{{ $car->year }}</h4>
                                </span>
                                <div class="span-group px-3 fw-bold" style="font-size: 12px; font-family: 'Calisto MT', serif;">
                                    <span>{{ $car->seats . ' Seats' }}</span>
                                    <span>{{ $car->doors . ' Doors' }}</span>
                                    <span>Automatic</span>
                                    <span style="background-color: blue;">
                                    Bases
                                    </span>
                                </div>
                                <a href="{{ route('cars.show', $car->id) }}">
                                    <div>
                                        <img src="{{ asset('storage/' . $car->car_picture) }}" alt="Car Picture" class="w-100">
                                    </div>
                                </a>
                                <div class="row mb-5 gx-2 justify-content-center">
                                    <div class="col-4">
                                        <h4 class="text-center text-white" style="font-family: 'Calisto MT', serif; font-size: medium;">Daily</h4>
                                        <h6 class="text-center text-white fw-bold" style="font-family: 'Calisto MT', serif; font-size: large;">{{ $car->price_daily }} <span>AED</span></h6>
                                    </div>

                                    <div class="col-4">
                                        <h4 class="text-center text-white" style="font-family: 'Calisto MT', serif; font-size: medium;">Weekly</h4>
                                        <h6 class="text-center text-white fw-bold" style="font-family: 'Calisto MT', serif; font-size: large;">{{ $car->price_weekly }} <span>AED</span></h6>
                                    </div>

                                    <div class="col-4">
                                        <h4 class="text-center text-white" style="font-family: 'Calisto MT', serif; font-size: medium;">Monthly</h4>
                                        <h6 class="text-center text-white fw-bold" style="font-family: 'Calisto MT', serif; font-size: large;">{{ $car->price_monthly }} <span>AED</span></h6>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mb-3 d-flex justify-content-start">
                                                <button class="btn text-center my-2" style="background-color: #949494; color: white; font-family: 'Calisto MT', serif;" data-bs-toggle="modal" data-bs-target="#bookingModal{{ $car->id }}">
                                                    Book Now
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-6 position-relative">
                                            <div class="mb-3">
                                                <!-- WhatsApp Icon as a clickable link -->
                                                <a href="https://wa.me/971542700030?text=Hi!%20I%20am%20interested%20in%20this%20car.%20Here%20is%20the%20link%20to%20the%20car:%20{{ route('cars.show', ['id' => $car->id]) }}%20and%20here%20is%20the%20image%20of%20the%20car:%20{{ asset('path/to/car-image.jpg') }}" target="_blank" class="position-absolute bottom-0 end-0 mb-4 me-3">
                                                    <i class="fab fa-whatsapp" style="font-size: 40px; color: #25D366;"></i>
                                                </a>
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
                                            <input type="hidden" name="car_picture" value="{{ asset('storage/' . $car->car_picture) }}"> <!-- Hidden input for the car picture -->

                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="alert alert-success contact__msg" style="display: none" role="alert"> Your message was sent successfully. </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-12">
                                                    <label>Car Name</label>
                                                    <input name="carName" type="text" class="form-control" value="{{ $car->car_name . ' ' . $car->model . ' ' . $car->year }}" readonly>
                                                </div>
                                                <div class="col-lg-6 col-md-12">
                                                    <label>Car ID</label>
                                                    <input type="text" class="form-control" value="{{ $car->id }}" name="carID" readonly>
                                                </div>
                                                <input type="hidden" name="plate_number" value="{{ $car->plate_number }}">
                                                <input type="hidden" name="price_daily" value="{{ $car->price_daily }}">


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
                                                                <option value="Sharjah">Sharjah</option>
                                                                <option value="Alain">Alain</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="input1_wrapper">
                                                        <label>Pick Up Date and Time</label>
                                                        <div class="input1_inner">
                                                            <input id="pickup_date" name="pickup_date" type="text" class="form-control input" placeholder="Pick Up Date and Time" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-12">
                                                    <div class="input1_wrapper">
                                                        <label>Return Up Date and Time</label>
                                                        <div class="input1_inner">
                                                            <input id="return_date" name="return_date" type="text" class="form-control input" placeholder="Return Up Date and Time" required>
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
                        <!-- End Booking Modal -->
                    @endif
                @endforeach
            </div>
        </section>





<!-- New Section with Centered Title and Clickable Labels -->
<section class="py-5 mt-5">
    <div class="container text-center">
        <!-- Section Title -->
        <h2 id="line-three" class="display-4 mb-4" style="font-family: 'Calisto MT', serif; color:#0F2026;">RENT ANY CAR YOU LIKE</h2>

        <!-- Tab Navigation for Smaller Screens -->
        <ul class="nav nav-pills justify-content-center mb-4" id="carTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="luxury-tab" data-bs-toggle="pill" href="#luxury" role="tab" aria-controls="luxury" aria-selected="true">
                    LUXURY
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="premium-tab" data-bs-toggle="pill" href="#premium" role="tab" aria-controls="premium" aria-selected="false">
                    PREMIUM
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="economy-tab" data-bs-toggle="pill" href="#economy" role="tab" aria-controls="economy" aria-selected="false">
                    ECONOMY
                </a>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="carTabsContent">
            <!-- Luxury Tab -->
            <div class="tab-pane fade show active" id="luxury" role="tabpanel" aria-labelledby="luxury-tab">
                <a href="{{ route('luxury.page') }}" class="d-block text-decoration-none text-dark">
                    <div class="d-flex align-items-center justify-content-center position-relative rounded mb-4">
                        <img src="{{asset('front/img/luxurycar.jpeg')}}" alt="Luxury Car" class="img-fluid rounded w-100">
                        <div class="overlay position-absolute w-100 h-100 bg-dark opacity-50 rounded"></div>
                        <div class="text-center position-absolute">
                            <h4 class="text-white" style="font-size: 2.5rem; font-weight: bold; text-transform: uppercase;">LUXURY</h4>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Premium Tab -->
            <div class="tab-pane fade" id="premium" role="tabpanel" aria-labelledby="premium-tab">
                <a href="{{ route('premium.page') }}" class="d-block text-decoration-none text-dark">
                    <div class="d-flex align-items-center justify-content-center position-relative rounded mb-4">
                        <img src="{{ asset('front/img/premium.png') }}" alt="Premium Car" class="img-fluid rounded w-100">
                        <div class="overlay position-absolute w-100 h-100 bg-dark opacity-50 rounded"></div>
                        <div class="text-center position-absolute">
                            <h4 class="text-white" style="font-size: 2.5rem; font-weight: bold; text-transform: uppercase;">PREMIUM</h4>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Economy Tab -->
            <div class="tab-pane fade" id="economy" role="tabpanel" aria-labelledby="economy-tab">
                <a href="{{ route('economy.page') }}" class="d-block text-decoration-none text-dark">
                    <div class="d-flex align-items-center justify-content-center position-relative rounded mb-4">
                        <img src="{{ asset('front/img/economy.jpg') }}" alt="Economy Car" class="img-fluid rounded w-100">
                        <div class="overlay position-absolute w-100 h-100 bg-dark opacity-50 rounded"></div>
                        <div class="text-center position-absolute">
                            <h4 class="text-white" style="font-size: 2.5rem; font-weight: bold; text-transform: uppercase;">ECONOMY</h4>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>




<!--Instagram-->
<section class="instagram-posts-section py-5 my-5">
    <div class="container text-center">
        <h2 class="display-4 mb-4">Latest Instagram Posts</h2>
        <div class="row">
            <!-- Instagram Post 1 -->

            <div class="col-md-4 mb-4">
            <blockquote class="instagram-media" data-instgrm data-instgrm-permalink="https://www.instagram.com/p/DCyJCyJNthH/?utm_source=ig_embed&amp;utm_campaign=loading" data-instgrm-version="14" style=" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:540px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);">
                <div style="padding:16px;"> 
                    <a href="https://www.instagram.com/p/DCyJCyJNthH/?utm_source=ig_embed&amp;utm_campaign=loading" style=" background:#FFFFFF; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;" target="_blank"> 
                        <div style=" display: flex; flex-direction: row; align-items: center;"> 
                            <div style="background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 40px; margin-right: 14px; width: 40px;"></div> 
                            <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center;"> 
                                <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 100px;"></div> 
                                <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 60px;">

                                </div>
                            </div>
                        </div>
                        <div style="padding: 19% 0;"></div> 
                        <div style="display:block; height:50px; margin:0 auto 12px; width:50px;"><svg width="50px" height="50px" viewBox="0 0 60 60" version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g transform="translate(-511.000000, -20.000000)" fill="#000000"><g><path d="M556.869,30.41 C554.814,30.41 553.148,32.076 553.148,34.131 C553.148,36.186 554.814,37.852 556.869,37.852 C558.924,37.852 560.59,36.186 560.59,34.131 C560.59,32.076 558.924,30.41 556.869,30.41 M541,60.657 C535.114,60.657 530.342,55.887 530.342,50 C530.342,44.114 535.114,39.342 541,39.342 C546.887,39.342 551.658,44.114 551.658,50 C551.658,55.887 546.887,60.657 541,60.657 M541,33.886 C532.1,33.886 524.886,41.1 524.886,50 C524.886,58.899 532.1,66.113 541,66.113 C549.9,66.113 557.115,58.899 557.115,50 C557.115,41.1 549.9,33.886 541,33.886 M565.378,62.101 C565.244,65.022 564.756,66.606 564.346,67.663 C563.803,69.06 563.154,70.057 562.106,71.106 C561.058,72.155 560.06,72.803 558.662,73.347 C557.607,73.757 556.021,74.244 553.102,74.378 C549.944,74.521 548.997,74.552 541,74.552 C533.003,74.552 532.056,74.521 528.898,74.378 C525.979,74.244 524.393,73.757 523.338,73.347 C521.94,72.803 520.942,72.155 519.894,71.106 C518.846,70.057 518.197,69.06 517.654,67.663 C517.244,66.606 516.755,65.022 516.623,62.101 C516.479,58.943 516.448,57.996 516.448,50 C516.448,42.003 516.479,41.056 516.623,37.899 C516.755,34.978 517.244,33.391 517.654,32.338 C518.197,30.938 518.846,29.942 519.894,28.894 C520.942,27.846 521.94,27.196 523.338,26.654 C524.393,26.244 525.979,25.756 528.898,25.623 C532.057,25.479 533.004,25.448 541,25.448 C548.997,25.448 549.943,25.479 553.102,25.623 C556.021,25.756 557.607,26.244 558.662,26.654 C560.06,27.196 561.058,27.846 562.106,28.894 C563.154,29.942 563.803,30.938 564.346,32.338 C564.756,33.391 565.244,34.978 565.378,37.899 C565.522,41.056 565.552,42.003 565.552,50 C565.552,57.996 565.522,58.943 565.378,62.101 M570.82,37.631 C570.674,34.438 570.167,32.258 569.425,30.349 C568.659,28.377 567.633,26.702 565.965,25.035 C564.297,23.368 562.623,22.342 560.652,21.575 C558.743,20.834 556.562,20.326 553.369,20.18 C550.169,20.033 549.148,20 541,20 C532.853,20 531.831,20.033 528.631,20.18 C525.438,20.326 523.257,20.834 521.349,21.575 C519.376,22.342 517.703,23.368 516.035,25.035 C514.368,26.702 513.342,28.377 512.574,30.349 C511.834,32.258 511.326,34.438 511.181,37.631 C511.035,40.831 511,41.851 511,50 C511,58.147 511.035,59.17 511.181,62.369 C511.326,65.562 511.834,67.743 512.574,69.651 C513.342,71.625 514.368,73.296 516.035,74.965 C517.703,76.634 519.376,77.658 521.349,78.425 C523.257,79.167 525.438,79.673 528.631,79.82 C531.831,79.965 532.853,80.001 541,80.001 C549.148,80.001 550.169,79.965 553.369,79.82 C556.562,79.673 558.743,79.167 560.652,78.425 C562.623,77.658 564.297,76.634 565.965,74.965 C567.633,73.296 568.659,71.625 569.425,69.651 C570.167,67.743 570.674,65.562 570.82,62.369 C570.966,59.17 571,58.147 571,50 C571,41.851 570.966,40.831 570.82,37.631"></path></g></g></g></svg></div><div style="padding-top: 8px;"> <div style=" color:#3897f0; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:550; line-height:18px;">View this post on Instagram</div></div><div style="padding: 12.5% 0;"></div> <div style="display: flex; flex-direction: row; margin-bottom: 14px; align-items: center;"><div> <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(0px) translateY(7px);"></div> <div style="background-color: #F4F4F4; height: 12.5px; transform: rotate(-45deg) translateX(3px) translateY(1px); width: 12.5px; flex-grow: 0; margin-right: 14px; margin-left: 2px;"></div> <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(9px) translateY(-18px);"></div></div><div style="margin-left: 8px;"> <div style=" background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 20px; width: 20px;"></div> <div style=" width: 0; height: 0; border-top: 2px solid transparent; border-left: 6px solid #f4f4f4; border-bottom: 2px solid transparent; transform: translateX(16px) translateY(-4px) rotate(30deg)"></div></div><div style="margin-left: auto;"> <div style=" width: 0px; border-top: 8px solid #F4F4F4; border-right: 8px solid transparent; transform: translateY(16px);"></div> <div style=" background-color: #F4F4F4; flex-grow: 0; height: 12px; width: 16px; transform: translateY(-4px);"></div> <div style=" width: 0; height: 0; border-top: 8px solid #F4F4F4; border-left: 8px solid transparent; transform: translateY(-4px) translateX(8px);"></div></div></div> <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center; margin-bottom: 24px;"> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 224px;"></div> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 144px;"></div></div></a><p style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;"><a href="https://www.instagram.com/p/DCyJCyJNthH/?utm_source=ig_embed&amp;utm_campaign=loading" style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none;" target="_blank">A post shared by Luxuria Rent car | UAE (@luxuria_uae)</a></p></div></blockquote>
                    <div style="padding:4px;"> 
                        <a href="https://www.instagram.com/p/DBwY8JEtjN3/?utm_source=ig_embed&amp;utm_campaign=loading" style="background:#FFFFFF; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;" target="_blank"> 
                   
                        </a>
                    </div>
                </blockquote>
            </div>
            <!-- Instagram Post 2 -->
            <div class="col-md-4 mb-4">
<blockquote class="instagram-media" data-instgrm data-instgrm-permalink="https://www.instagram.com/p/DCyIlqqtBcB/?utm_source=ig_embed&amp;utm_campaign=loading" data-instgrm-version="14" style=" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:540px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);"><div style="padding:16px;"> <a href="https://www.instagram.com/p/DCyIlqqtBcB/?utm_source=ig_embed&amp;utm_campaign=loading" style=" background:#FFFFFF; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;" target="_blank"> <div style=" display: flex; flex-direction: row; align-items: center;"> <div style="background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 40px; margin-right: 14px; width: 40px;"></div> <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center;"> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 100px;"></div> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 60px;"></div></div></div><div style="padding: 19% 0;"></div> <div style="display:block; height:50px; margin:0 auto 12px; width:50px;"><svg width="50px" height="50px" viewBox="0 0 60 60" version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g transform="translate(-511.000000, -20.000000)" fill="#000000"><g><path d="M556.869,30.41 C554.814,30.41 553.148,32.076 553.148,34.131 C553.148,36.186 554.814,37.852 556.869,37.852 C558.924,37.852 560.59,36.186 560.59,34.131 C560.59,32.076 558.924,30.41 556.869,30.41 M541,60.657 C535.114,60.657 530.342,55.887 530.342,50 C530.342,44.114 535.114,39.342 541,39.342 C546.887,39.342 551.658,44.114 551.658,50 C551.658,55.887 546.887,60.657 541,60.657 M541,33.886 C532.1,33.886 524.886,41.1 524.886,50 C524.886,58.899 532.1,66.113 541,66.113 C549.9,66.113 557.115,58.899 557.115,50 C557.115,41.1 549.9,33.886 541,33.886 M565.378,62.101 C565.244,65.022 564.756,66.606 564.346,67.663 C563.803,69.06 563.154,70.057 562.106,71.106 C561.058,72.155 560.06,72.803 558.662,73.347 C557.607,73.757 556.021,74.244 553.102,74.378 C549.944,74.521 548.997,74.552 541,74.552 C533.003,74.552 532.056,74.521 528.898,74.378 C525.979,74.244 524.393,73.757 523.338,73.347 C521.94,72.803 520.942,72.155 519.894,71.106 C518.846,70.057 518.197,69.06 517.654,67.663 C517.244,66.606 516.755,65.022 516.623,62.101 C516.479,58.943 516.448,57.996 516.448,50 C516.448,42.003 516.479,41.056 516.623,37.899 C516.755,34.978 517.244,33.391 517.654,32.338 C518.197,30.938 518.846,29.942 519.894,28.894 C520.942,27.846 521.94,27.196 523.338,26.654 C524.393,26.244 525.979,25.756 528.898,25.623 C532.057,25.479 533.004,25.448 541,25.448 C548.997,25.448 549.943,25.479 553.102,25.623 C556.021,25.756 557.607,26.244 558.662,26.654 C560.06,27.196 561.058,27.846 562.106,28.894 C563.154,29.942 563.803,30.938 564.346,32.338 C564.756,33.391 565.244,34.978 565.378,37.899 C565.522,41.056 565.552,42.003 565.552,50 C565.552,57.996 565.522,58.943 565.378,62.101 M570.82,37.631 C570.674,34.438 570.167,32.258 569.425,30.349 C568.659,28.377 567.633,26.702 565.965,25.035 C564.297,23.368 562.623,22.342 560.652,21.575 C558.743,20.834 556.562,20.326 553.369,20.18 C550.169,20.033 549.148,20 541,20 C532.853,20 531.831,20.033 528.631,20.18 C525.438,20.326 523.257,20.834 521.349,21.575 C519.376,22.342 517.703,23.368 516.035,25.035 C514.368,26.702 513.342,28.377 512.574,30.349 C511.834,32.258 511.326,34.438 511.181,37.631 C511.035,40.831 511,41.851 511,50 C511,58.147 511.035,59.17 511.181,62.369 C511.326,65.562 511.834,67.743 512.574,69.651 C513.342,71.625 514.368,73.296 516.035,74.965 C517.703,76.634 519.376,77.658 521.349,78.425 C523.257,79.167 525.438,79.673 528.631,79.82 C531.831,79.965 532.853,80.001 541,80.001 C549.148,80.001 550.169,79.965 553.369,79.82 C556.562,79.673 558.743,79.167 560.652,78.425 C562.623,77.658 564.297,76.634 565.965,74.965 C567.633,73.296 568.659,71.625 569.425,69.651 C570.167,67.743 570.674,65.562 570.82,62.369 C570.966,59.17 571,58.147 571,50 C571,41.851 570.966,40.831 570.82,37.631"></path></g></g></g></svg></div><div style="padding-top: 8px;"> <div style=" color:#3897f0; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:550; line-height:18px;">View this post on Instagram</div></div><div style="padding: 12.5% 0;"></div> <div style="display: flex; flex-direction: row; margin-bottom: 14px; align-items: center;"><div> <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(0px) translateY(7px);"></div> <div style="background-color: #F4F4F4; height: 12.5px; transform: rotate(-45deg) translateX(3px) translateY(1px); width: 12.5px; flex-grow: 0; margin-right: 14px; margin-left: 2px;"></div> <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(9px) translateY(-18px);"></div></div><div style="margin-left: 8px;"> <div style=" background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 20px; width: 20px;"></div> <div style=" width: 0; height: 0; border-top: 2px solid transparent; border-left: 6px solid #f4f4f4; border-bottom: 2px solid transparent; transform: translateX(16px) translateY(-4px) rotate(30deg)"></div></div><div style="margin-left: auto;"> <div style=" width: 0px; border-top: 8px solid #F4F4F4; border-right: 8px solid transparent; transform: translateY(16px);"></div> <div style=" background-color: #F4F4F4; flex-grow: 0; height: 12px; width: 16px; transform: translateY(-4px);"></div> <div style=" width: 0; height: 0; border-top: 8px solid #F4F4F4; border-left: 8px solid transparent; transform: translateY(-4px) translateX(8px);"></div></div></div> <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center; margin-bottom: 24px;"> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 224px;"></div> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 144px;"></div></div></a><p style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;"><a href="https://www.instagram.com/p/DCyIlqqtBcB/?utm_source=ig_embed&amp;utm_campaign=loading" style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none;" target="_blank">A post shared by Luxuria Rent car | UAE (@luxuria_uae)</a></p></div></blockquote></blockquote>
                </div>


                <!-- Instagram Post 3 -->
                <div class="col-md-4 mb-4">
<blockquote class="instagram-media" data-instgrm data-instgrm-permalink="https://www.instagram.com/p/DCyIPzMNTjv/?utm_source=ig_embed&amp;utm_campaign=loading" data-instgrm-version="14" style=" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:540px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);"><div style="padding:16px;"> <a href="https://www.instagram.com/p/DCyIPzMNTjv/?utm_source=ig_embed&amp;utm_campaign=loading" style=" background:#FFFFFF; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;" target="_blank"> <div style=" display: flex; flex-direction: row; align-items: center;"> <div style="background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 40px; margin-right: 14px; width: 40px;"></div> <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center;"> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 100px;"></div> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 60px;"></div></div></div><div style="padding: 19% 0;"></div> <div style="display:block; height:50px; margin:0 auto 12px; width:50px;"><svg width="50px" height="50px" viewBox="0 0 60 60" version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g transform="translate(-511.000000, -20.000000)" fill="#000000"><g><path d="M556.869,30.41 C554.814,30.41 553.148,32.076 553.148,34.131 C553.148,36.186 554.814,37.852 556.869,37.852 C558.924,37.852 560.59,36.186 560.59,34.131 C560.59,32.076 558.924,30.41 556.869,30.41 M541,60.657 C535.114,60.657 530.342,55.887 530.342,50 C530.342,44.114 535.114,39.342 541,39.342 C546.887,39.342 551.658,44.114 551.658,50 C551.658,55.887 546.887,60.657 541,60.657 M541,33.886 C532.1,33.886 524.886,41.1 524.886,50 C524.886,58.899 532.1,66.113 541,66.113 C549.9,66.113 557.115,58.899 557.115,50 C557.115,41.1 549.9,33.886 541,33.886 M565.378,62.101 C565.244,65.022 564.756,66.606 564.346,67.663 C563.803,69.06 563.154,70.057 562.106,71.106 C561.058,72.155 560.06,72.803 558.662,73.347 C557.607,73.757 556.021,74.244 553.102,74.378 C549.944,74.521 548.997,74.552 541,74.552 C533.003,74.552 532.056,74.521 528.898,74.378 C525.979,74.244 524.393,73.757 523.338,73.347 C521.94,72.803 520.942,72.155 519.894,71.106 C518.846,70.057 518.197,69.06 517.654,67.663 C517.244,66.606 516.755,65.022 516.623,62.101 C516.479,58.943 516.448,57.996 516.448,50 C516.448,42.003 516.479,41.056 516.623,37.899 C516.755,34.978 517.244,33.391 517.654,32.338 C518.197,30.938 518.846,29.942 519.894,28.894 C520.942,27.846 521.94,27.196 523.338,26.654 C524.393,26.244 525.979,25.756 528.898,25.623 C532.057,25.479 533.004,25.448 541,25.448 C548.997,25.448 549.943,25.479 553.102,25.623 C556.021,25.756 557.607,26.244 558.662,26.654 C560.06,27.196 561.058,27.846 562.106,28.894 C563.154,29.942 563.803,30.938 564.346,32.338 C564.756,33.391 565.244,34.978 565.378,37.899 C565.522,41.056 565.552,42.003 565.552,50 C565.552,57.996 565.522,58.943 565.378,62.101 M570.82,37.631 C570.674,34.438 570.167,32.258 569.425,30.349 C568.659,28.377 567.633,26.702 565.965,25.035 C564.297,23.368 562.623,22.342 560.652,21.575 C558.743,20.834 556.562,20.326 553.369,20.18 C550.169,20.033 549.148,20 541,20 C532.853,20 531.831,20.033 528.631,20.18 C525.438,20.326 523.257,20.834 521.349,21.575 C519.376,22.342 517.703,23.368 516.035,25.035 C514.368,26.702 513.342,28.377 512.574,30.349 C511.834,32.258 511.326,34.438 511.181,37.631 C511.035,40.831 511,41.851 511,50 C511,58.147 511.035,59.17 511.181,62.369 C511.326,65.562 511.834,67.743 512.574,69.651 C513.342,71.625 514.368,73.296 516.035,74.965 C517.703,76.634 519.376,77.658 521.349,78.425 C523.257,79.167 525.438,79.673 528.631,79.82 C531.831,79.965 532.853,80.001 541,80.001 C549.148,80.001 550.169,79.965 553.369,79.82 C556.562,79.673 558.743,79.167 560.652,78.425 C562.623,77.658 564.297,76.634 565.965,74.965 C567.633,73.296 568.659,71.625 569.425,69.651 C570.167,67.743 570.674,65.562 570.82,62.369 C570.966,59.17 571,58.147 571,50 C571,41.851 570.966,40.831 570.82,37.631"></path></g></g></g></svg></div><div style="padding-top: 8px;"> <div style=" color:#3897f0; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:550; line-height:18px;">View this post on Instagram</div></div><div style="padding: 12.5% 0;"></div> <div style="display: flex; flex-direction: row; margin-bottom: 14px; align-items: center;"><div> <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(0px) translateY(7px);"></div> <div style="background-color: #F4F4F4; height: 12.5px; transform: rotate(-45deg) translateX(3px) translateY(1px); width: 12.5px; flex-grow: 0; margin-right: 14px; margin-left: 2px;"></div> <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(9px) translateY(-18px);"></div></div><div style="margin-left: 8px;"> <div style=" background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 20px; width: 20px;"></div> <div style=" width: 0; height: 0; border-top: 2px solid transparent; border-left: 6px solid #f4f4f4; border-bottom: 2px solid transparent; transform: translateX(16px) translateY(-4px) rotate(30deg)"></div></div><div style="margin-left: auto;"> <div style=" width: 0px; border-top: 8px solid #F4F4F4; border-right: 8px solid transparent; transform: translateY(16px);"></div> <div style=" background-color: #F4F4F4; flex-grow: 0; height: 12px; width: 16px; transform: translateY(-4px);"></div> <div style=" width: 0; height: 0; border-top: 8px solid #F4F4F4; border-left: 8px solid transparent; transform: translateY(-4px) translateX(8px);"></div></div></div> <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center; margin-bottom: 24px;"> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 224px;"></div> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 144px;"></div></div></a><p style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;"><a href="https://www.instagram.com/p/DCyIPzMNTjv/?utm_source=ig_embed&amp;utm_campaign=loading" style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none;" target="_blank">A post shared by Luxuria Rent car | UAE (@luxuria_uae)</a></p></div></blockquote>
            </div>
        </div>
</section>





<section class="newsletter-section bg-light" style="min-height: 500px; position: relative; background-image: url('front/img/newss.jpg'); background-size: cover; background-position: center center; display: flex; justify-content: center; align-items: center;">
   <!-- Dark overlay -->
   <div class="overlay"></div>

   <div class="container text-center position-relative">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2 class="display-4 mb-4" style="font-family: 'Calisto MT', serif; color: white; font-size: 50px;">Subscribe To Our Newsletter</h2>
                
                <form action="#" method="post">
                    @csrf
                    <div class="input-group input-group-lg">
                        <input type="email" class="form-control" name="email" placeholder="Enter your email" required>


                    </div>
                    <button class="btn btn-primary" type="submit">
                                <i class="fas fa-paper-plane"></i> Subscribe
                            </button>   


                </form>
                
                <!-- Optional success or error messages -->
                @if(session('success'))
                    <div class="alert alert-success mt-4">
                        {{ session('success') }}
                    </div>
                @elseif(session('error'))
                    <div class="alert alert-danger mt-4">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection
