@extends('front.layouts.master')

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://unpkg.com/sweetalert/dist/sweetalert.css">
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;700&display=swap" rel="stylesheet">
    <!-- Include intl-tel-input CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@17.0.8/build/css/intlTelInput.css">

<!-- Include intl-tel-input utils (for formatting and validation) -->
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@17.0.8/build/js/intlTelInput.js"></script>


    <style>
 /* Ensure that the phone number input field matches the design of other input fields */
#phone {
    height: 50px; /* Same height as other input fields */
    border-radius: .25rem; /* Match the border-radius of the other fields */
    background-color: #fff; /* Same background as the other fields */
    border: 1px solid #ced4da; /* Border color */
}

/* Styling the flag dropdown part */
.iti__flag-container {
    height: 100%; /* Make flag container match height */
    border-radius: .25rem; /* Match border-radius */
}

/* Remove the left border from the input field */
.iti__input {
    border-left: none;
    border-radius: .25rem; /* Match border-radius */
    background-color: #fff; /* Match background */
    height: 50px; /* Match the height */
}

/* Adjust the flag and dropdown to match design */
.iti__selected-flag {
    height: 100%;
    width: 40px; /* Control the size of the flag */
    border-radius: .25rem; /* Match border-radius */
}

/* Adjusting input inside the dropdown */
.iti__input {
    padding-left: 45px; /* Make space for flag */
}

/* Ensuring consistent focus style with other fields */
#phone:focus, .iti__input:focus {
    border-color: #80bdff; /* Highlight border on focus */
    box-shadow: 0 0 0 0.25rem rgba(38, 143, 255, 0.25); /* Optional: Add focus shadow */
}
/* Ensure the phone number input field matches the design of other input fields */
#phone {
    width: 100%;  /* Ensures the input takes up the full width of the container */
    height: 50px; /* Same height as other input fields */
    border-radius: .25rem; /* Match the border-radius of other fields */
    background-color: #fff; /* Same background as other fields */
    border: 1px solid #ced4da; /* Match the border color of other input fields */
    padding-left: 45px; /* Space for flag icon */
}

/* Styling the flag dropdown part */
.iti__flag-container {
    height: 100%; /* Ensure flag container matches the height of the input */
    border-radius: .25rem; /* Match the border-radius of the input */
}

/* Remove the left border from the input field to prevent double borders */
.iti__input {
    border-left: none;
    border-radius: .25rem; /* Match border-radius */
    background-color: #fff; /* Match the background color */
    height: 50px; /* Match the height */
}

/* Adjust the flag size and appearance */
.iti__selected-flag {
    height: 100%;
    width: 40px; /* Control the width of the flag */
    border-radius: .25rem; /* Match border-radius */
}

/* Ensure consistent focus styles with other input fields */
#phone:focus, .iti__input:focus {
    border-color: #80bdff; /* Highlight border on focus */
    box-shadow: 0 0 0 0.25rem rgba(38, 143, 255, 0.25); /* Optional: Add focus shadow */
}

/* Ensure proper alignment of the phone input */
.iti__input {
    padding-left: 45px; /* Leave space for the country flag icon */
}

</style>


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
                                {{ $car->car_name . ' ' . $car->model . ' ' . $car->year }}
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
                                    ['icon' => 'free-delivery.png', 'label' => 'Free Delivery', 'value' => ''],
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
                                    <a data-bs-toggle="modal" data-bs-target="#exampleModal" href="#0">Rent Now</a>
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
                                        <div class="alert alert-success contact__msg" style="display: none" role="alert">Your message was sent successfully.</div>
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
                                    <div class="input-group">

                                        
                                        <!-- Phone Number Input -->
                                            <!-- Phone Number Input with Country Code Dropdown -->    
                                            <input id="phone" name="phone" type="tel" class="form-control" placeholder="Phone *" required>


                                        
                                        </div>
                                </div>



                                    <div class="col-lg-6 col-md-12">
                                        <label>Pick Up Location</label>
                                        <select name="pickup_city" class="select2 select" style="width: 100%" required>
                                            <option value="" disabled selected>Select a City</option>
                                            <option value="Dubai">Dubai</option>
                                            <option value="Sharjah">Sharjah</option>
                                            <option value="Al Ain">Al Ain</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <input name="pickup_date" type="text" class="form-control input datepicker" placeholder="Pick Up Date" required>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <input name="return_date" type="text" class="form-control input datepicker" placeholder="Return Date" required>
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

    <script>
            $(document).ready(function(){
            $('.datepicker').datepicker({
                minDate: 0  // This ensures the user can only select today's date or any future date
            });
        });

        
    </script>

<script>
    // Initialize the intl-tel-input plugin
    var input = document.querySelector("#phone");
    var iti = window.intlTelInput(input, {
        initialCountry: "us", // Set default country (optional)
        preferredCountries: ["us", "gb", "fr", "de", "in"], // Optional: Preferred countries to show first
        utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@17.0.8/build/js/utils.js", // Optional: For validation and formatting
    });
</script>

@endsection
