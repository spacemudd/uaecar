@extends('front.layouts.master')
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-11504797989"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'AW-11504797989');
</script>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/owl.carousel.min.js"></script>
<script async src="//www.instagram.com/embed.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('success_message'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Payment has been Accepted',
                text: "Thanks for your payment, We will contact you as soon as possible",
                icon: 'success',
                confirmButtonText: 'OK'
            });
        });
    </script>
@endif

@if (session('cancel_message'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Payment has been Canceled',
                text: "Your request has been canceled, please check back later",
                icon: 'error',
                confirmButtonText: 'close'
            });
        });
    </script>
@endif

@if (session('failure_message'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Payment has been Failed',
                text: "Your request has been Failed, please check back later",
                icon: 'error',
                confirmButtonText: 'close'
            });
        });
    </script>
@endif


@if (session('error_message'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'This Car is currently booked !',
                text: "",
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
                            @foreach(session('car_data') as $index => $car)
                                <div class="col-4 text-center">
                                    <a href="#" style="text-decoration: none; color: inherit;">
                                        <img src="{{ asset('storage/' . $car['car_picture']) }}" alt="Car {{ $index + 1 }}" class="img-fluid" style="max-width: 70%; height: auto; margin-bottom: 10px;">
                                        <h6>{{ $car['car_name'] }}</h6>
                                        <p>{{ $car['price_daily'] }} AED</p>
                                    </a>
                                </div>
                            @endforeach
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
<section class="clients mt-1 my-0">
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

<!-- Luxury Cars Section -->
<section class=" my-0 py-0 px-3 mx-auto">
        
            <div class="row ">
                <div class="col-12 position-relative d-flex justify-content-center align-items-center" style="background-color: black; width: 100vw;">
                    <!-- Centered Title -->
                    <div id="text-container">
                        <div id="line-one">
                            <h1 class="display-3 mb-4" style="color:white;">Luxury Cars</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row gy-2 mt-4" style="background-color: white;">
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
                         <!-- استدعاء مكون الحجز -->
                        <x-booking-modal :car="$car" />
                        
                    @endif
                @endforeach
            </div>
</section>

        
<!-- MidRange Cars Section -->
<section class="cars2 section-padding my-0 py-0 px-3 mx-auto py-5 mt-5">
            
            <div class="row mt-4">
                <div class="col-12 position-relative d-flex justify-content-center align-items-center" style="background-color: black; width: 100vw;">
                    <!-- Centered Title -->
                    <div id="text-container">
                        <div id="line-one">
                            <h1 class="display-3 mb-4" style="color:white;">Mid Range</h1>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Adjusting the row for luxury cars -->
            <div class="row gy-2 mt-4" style="background-color: white;">
            @foreach($cars as $car)
                @if(strtolower($car->categories) === 'mid range')  <!-- Filter only luxury cars -->
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
                                <span style="background-color: green; color: white;">Mid Range</span>
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
                    <x-booking-modal :car="$car" />
                @endif
            @endforeach
            </div>

</section>

<!-- Economy Cars Section -->
<section class="cars2 section-padding my-0 py-0 px-3 mx-auto py-5 mt-5">
            <div class="row mt-4">
                <div class="col-12 position-relative d-flex justify-content-center align-items-center" style="background-color: black; width: 100vw;">
                    <div id="text-container">
                        <div id="line-one">
                            <h1 class="display-3 mb-4" style="color:white;">Economy</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row gy-2 mt-4" style="background-color: white;">
                @foreach($cars as $car)
                    @if(strtolower($car->categories) === 'economy')  <!-- Filter only luxury cars -->
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
                                    <span style="background-color: orange; color: white;">Economy</span>
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
                         <x-booking-modal :car="$car" />
                    @endif
                @endforeach
            </div>
</section>

<!-- Sport Section -->
<section class="cars2 section-padding my-0 py-0 px-3 mx-auto py-5 mt-5">
        
            <div class="row mt-4">
                <div class="col-12 position-relative d-flex justify-content-center align-items-center" style="background-color: black; width: 100vw;">
                    <!-- Centered Title -->
                    <div id="text-container">
                        <div id="line-one">
                            <h1 class="display-3 mb-4" style="color:white;">Sports</h1>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Adjusting the row for luxury cars -->
            <div class="row gy-2 mt-4" style="background-color: white;">
                @foreach($cars as $car)
                    @if(strtolower($car->categories) === 'sports and exotics')  <!-- Filter only luxury cars -->
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
                                    <span style="background-color: #1B1B1B; color: white;">Sport</span>
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
                          <x-booking-modal :car="$car" />
                    @endif
                @endforeach
            </div>

</section>

<!-- Vans and Busses Cars Section -->
<section class="cars2 section-padding my-0 py-0 px-3 mx-auto py-5 mt-5"> 
            <div class="row mt-4">
                <div class="col-12 position-relative d-flex justify-content-center align-items-center" style="background-color: black; width: 100vw;">
                    <!-- Centered Title -->
                    <div id="text-container">
                        <div id="line-one">
                            <h1 class="display-3 mb-4" style="color:white;">Vans and Buses</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row gy-2 mt-4" style="background-color: white;">
                @foreach($cars as $car)
                    @if(strtolower($car->categories) === 'vans and buses')  <!-- Filter only luxury cars -->
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
                                    <span style="background-color: blue; color: white;">Vans and Buses</span>
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
                          <x-booking-modal :car="$car" />
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
                            Mid Range
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
                                    <h4 class="text-white" style="font-size: 2.5rem; font-weight: bold; text-transform: uppercase;">Mid Range</h4>
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
                <blockquote class="instagram-media" data-instgrm-permalink="https://www.instagram.com/p/DD6dgN8NQKO/?utm_source=ig_embed&amp;utm_campaign=loading" data-instgrm-version="14" style=" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:540px; min-width:326px; padding:0; width:100%;">
                    <div style="padding:16px;">
                        <a href="https://www.instagram.com/p/DD6dgN8NQKO/?utm_source=ig_embed&amp;utm_campaign=loading" style=" background:#FFFFFF; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;" target="_blank">
                            <img src="URL_TO_IMAGE" alt="Instagram Image" style="width: 100%; height: auto; border-radius: 10px;">
                        </a>
                    </div>
                </blockquote>
            </div>

            <!-- Instagram Post 2 -->
            <div class="col-md-4 mb-4">

            <blockquote class="instagram-media" data-instgrm-permalink="https://www.instagram.com/p/DDo2C9jtymG/?utm_source=ig_embed&amp;utm_campaign=loading" data-instgrm-version="14" style="background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:540px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);">
                <div style="padding:16px;">
                    <a href="https://www.instagram.com/p/DDo2C9jtymG/?utm_source=ig_embed&amp;utm_campaign=loading" style="background:#FFFFFF; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;" target="_blank">
                    </a>
                </div>
            </blockquote>
            </div>




            <!-- Instagram Post 3 -->
            <div class="col-md-4 mb-4">
            <blockquote class="instagram-media" data-instgrm-permalink="https://www.instagram.com/p/DDrSsW2tkFG/?utm_source=ig_embed&amp;utm_campaign=loading" data-instgrm-version="14" style=" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:540px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);">
                <div style="padding:16px;">
                    <a href="https://www.instagram.com/p/DDrSsW2tkFG/?utm_source=ig_embed&amp;utm_campaign=loading" style=" background:#FFFFFF; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;" target="_blank">
                    </a>
                </div>
            </blockquote>

            </div>
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
