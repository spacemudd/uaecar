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


            <div class="row gy-2 mt-4" style="background-color: white;">
                @foreach($cars as $car)
                    @if(($car->price_daily) > 349)  <!-- Filter only luxury cars -->
                        <!-- Car Card -->
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-3" style="text-decoration: none;">
                            <div class="card3 w-100">
                                <span class="px-4 py-3" style="display: inline-block;">
                                    <h3 class="car_name" style="display: inline-block; margin: 0; font-size: 23px; font-family: 'Calisto MT', serif;">{{ $car->car_name . ' ' . $car->model}}</h3>
                                    <br>
                                </span>
                                <div class="span-group px-3 fw-bold" style="font-size: 12px; font-family: 'Calisto MT', serif;">
                                    <span>{{ $car->seats . ' Seats' }}</span>
                                    <span>{{ $car->doors . ' Doors' }}</span>
                                    <span>Automatic</span>
                                    @if ($car->price_daily > 349)
                                        <span style="background-color: green; color:white">No Deposit</span>
                                    @endif
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

@endsection
