@extends('front.layouts.master')

@section('scripts')
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-11504797989"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'AW-11504797989');
</script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://unpkg.com/sweetalert/dist/sweetalert.css">
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <style>
.ui-datepicker .ui-state-disabled {
    color: #b0b0b0; /* Gray color */
    background-color: #f0f0f0; /* Light gray background */
    border: 1px solid #d0d0d0; /* Light gray border */
    cursor: not-allowed; /* Change cursor to indicate the date is disabled */
}

</style>
<script>
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
    <!-- Preloader Section -->
    <div class="preloader-bg"></div>
    <div id="preloader">
        <div id="preloader-status">
            <div class="preloader-position loader"><span></span></div>
        </div>
    </div>

    <!-- Header Section -->
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
                width: 18px;
                height: 18px;
                margin-right: 10px;
            }
            @media (max-width: 600px) {
                .slogan {
                    display: none;
                }
            }
            .carousel-item img {
                max-height: 700px;
                object-fit: cover;
            }
        </style>
    </header>

    <!-- Car Details Section -->
    <section id="cars" class="my-0 py-0">
        <div class="my-container mx-auto">
            <div class="row gy-2">
                <!-- Carousel and Description -->
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

                    <h3 style="font-family: 'Calisto MT', serif;">About the Car</h3>
                    <p style="font-family: 'Calisto MT', serif; color:black;">{{ $car->description }}</p>
                </div>

                <!-- Car Information Card -->
                <div class="col-lg-4">
                    <div class="card about-card">
                        <div class="card-body">
                            <h1 class="fs-3" style="font-family: 'Calisto MT', serif;">
                                {{ $car->car_name . ' ' . $car->model}}
                            </h1>
                            <p class="text-end my-0 py-0 pe-1 fw-bold fs-6">
                                Daily Cost: <span class="fs-4" style="font-family: 'Calisto MT', serif;">{{ $car->price_daily }} AED </span>
                            </p>

                            <!-- Progress Bar -->
                            <div class="progress mt-1" style="height:8px;" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar w-25"></div>
                            </div>

                            <!-- Additional Notes -->
                            <p class="myPar py-2 fs-6" style="font-family: 'Calisto MT', serif;">P.S. Please note that the limit is 450 kilometers per day and 4,500 kilometers per month. Any additional kilometers will incur a charge of 1 Dirham each.</p>

                            <!-- Car Features -->
                            <div class="row gy-3">
                                @foreach([
                                    ['icon' => 'car-seat.png', 'label' => 'Seats', 'value' => $car->seats],
                                    
                                    ['icon' => 'car.png', 'label' => 'Doors', 'value' => $car->doors],
                                    ['icon' => 'free-delivery.png', 'label' => 'Free Delivery', 'value' => 'Free Delivery'],
                                    ['icon' => 'gear.png', 'label' => 'Gear', 'value' => $car->gear],
                                    ['icon' => 'wallet.png', 'label' => 'Daily Price', 'value' => $car->price_daily . ' AED'],
                                    ['icon' => 'wallet.png', 'label' => 'Weekly Price', 'value' => number_format($car->price_weekly, 0) . ' AED'],
                                    ['icon' => 'wallet.png', 'label' => 'Monthly Price', 'value' => number_format($car->price_monthly, 0) . ' AED'],
                                    ['icon' => 'calendar.png', 'label' => 'Year', 'value' => $car->year],
                                    ['icon' => 'mileage.png', 'label' => 'kilo_monthly', 'value' => '4,500/km Monthly'],
                                    ['icon' => 'mileage.png', 'label' => 'kilo_daily', 'value' => '450/km Daily'],
                                    ['icon' => 'signal.png', 'label' => 'Category', 'value' => $car->categories]
                                ] as $feature)
                                    <div class="col-6 mb-3">
                                        <div class="row align-items-center">
                                            <div class="col-4">
                                                <div class="blue-icon">
                                                    <img src="{{ asset('front/img/icons/' . $feature['icon']) }}" alt="{{ $feature['label'] }}" class="icon-img" style="width: 30px; height: 30px;">
                                                </div>
                                            </div>
                                            <div class="col-8">
                                                <h5 class="small fs-6">{{ $feature['value'] }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <!-- Rent Now and WhatsApp Button -->
                                @php
                                    $carName = urlencode($car->car_name);
                                    $carPicture = asset('storage/' . $car->car_picture);
                                    $message = "Hello, I am interested in the car: $carName. Here is the picture: $carPicture";
                                    $whatsappLink = "https://api.whatsapp.com/send?phone=971542700030&text=" . urlencode($message);
                                @endphp

                                <div class="btn-double mt-30" data-grouptype="&amp;">
                                    <a data-bs-toggle="modal" data-bs-target="#bookingModal{{ $car->id }}" href="#0">Book Now</a>
                                    <a href="{{ $whatsappLink }}" target="_blank"><span class="fa-brands fa-whatsapp"></span> WhatsApp</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal for Booking Form -->
    <x-booking-modal :car="$car" />


@endsection
