@extends('front.layouts.master')

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://unpkg.com/sweetalert/dist/sweetalert.css">
<link rel="stylesheet" href="{{ asset('front/css/car-details/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('front/css/car-details/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('front/css/car-details/index.css') }}">

<script>
$(document).ready(function() {
    $('.contact__form').on('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission

        const form = $(this); // Reference the current form
        console.log('Form action URL:', form.attr('action')); // Log the form action URL

        $.ajax({
            url: form.attr('action'), // The form action URL
            type: 'POST',
            data: form.serialize(), // Serialize the form data
            success: function(response) {
                console.log('AJAX response:', response); // Log the response
                if (response.success) {
                    swal("Thank You for Your Request!", "Your request has been successfully submitted, and our team will review it shortly. We will contact you as soon as possible to confirm your booking.", "success").then(() => {
                        // Reset the form fields
                        form[0].reset();
                        // Close the modal
                        form.closest('.modal').modal('hide');
                    });
                } else {
                    swal("Error!", "There was a problem with your request.", "error");
                }
            },
            error: function(xhr) {
                console.error(xhr); // Log the error response
                swal("Error!", "There was a problem with your request. Please try again.", "error");
            }
        });
    });
});
</script>
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

<section id="cars" class="py-5">
    <div class="container">
        <h1>{{ $car->car_name . ' ' .  $car->model . ' ' . $car->year }}</h1>
        <div class="row py-3 gy-2">
            <div class="col-lg-8">
            <div id="carCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('front/img/gallery/Mercedes Benz S500/Le15.jpg') }}" class="d-block w-100" alt="Car Image">
        </div>
        @foreach($images as $image)
            <div class="carousel-item">
                <img src="{{ asset($image->image_path) }}" class="d-block w-100" alt="Car Image">
            </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<br>

                <h3>About the Car</h3>
                <p>{{ $car->description }}</p>
            </div>

            <div class="col-lg-4">
                <div class="card about-card py-2">
                    <div class="card-body">
                        <h3 class="text-start my-0">About Car</h3>
                        <p class="text-end my-0 py-0 pe-1 fw-bold">
    Daily Cost: <span class="fs-2">{{ $car->price_daily }} AED </span>
</p>                        <div class="progress mt-0" style="height:7px;" role="progressbar" aria-label="Basic example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar w-25"></div>
                        </div>
                        <p class="myPar py-3">P.S. Please note that the limit is 450 kilometers per day and 4,500 kilometers per month. Any additional kilometers will incur a charge of 1 Dirham each.</p>

                        <div class="row gy-7">
                        <div class="col-6">
    <div class="row">
        <div class="col-4">
            <div class="blue-icon">
                <img src="{{ asset('front/img/icons/car-seat.png') }}" alt="Seats" class="icon-img" />
            </div>
        </div>
        <div class="col-8">
            <h5 class="small">{{ $car->seats }} Seats</h5>
        </div>
    </div>
</div>
<div class="col-6">
    <div class="row">
        <div class="col-4">
            <div class="blue-icon">
                <img src="{{ asset('front/img/icons/car.png') }}" alt="Doors" class="icon-img" />
            </div>
        </div>
        <div class="col-8">
            <h5 class="small">{{ $car->doors }} Doors</h5>
        </div>
    </div>
</div>
<div class="col-6">
    <div class="row">
        <div class="col-4">
            <div class="blue-icon">
                <img src="{{ asset('front/img/icons/free-delivery.png') }}" alt="Delivery" class="icon-img" />
            </div>
        </div>
        <div class="col-8">
            <h5 class="small">{{ $car->delivery == 1 ? 'Free' : 'Not Free' }} Delivery</h5>
        </div>
    </div>
</div>
<div class="col-6">
    <div class="row">
        <div class="col-4">
            <div class="blue-icon">
                <img src="{{ asset('front/img/icons/gear.png') }}" alt="Gear" class="icon-img" />
            </div>
        </div>
        <div class="col-8">
            <h5 class="small">{{ $car->gear }}</h5>
        </div>
    </div>
</div>
<div class="col-6">
    <div class="row">
        <div class="col-4">
            <div class="blue-icon">
                <img src="{{ asset('front/img/icons/wallet.png') }}" alt="Daily Price" class="icon-img" />
            </div>
        </div>
        <div class="col-8">
            <h5 class="small">{{ $car->price_daily }}/Daily</h5>
        </div>
    </div>
</div>
<div class="col-6">
    <div class="row">
        <div class="col-4">
            <div class="blue-icon">
                <img src="{{ asset('front/img/icons/wallet.png') }}" alt="Weekly Price" class="icon-img" />
            </div>
        </div>
        <div class="col-8">
            <h5 class="small">{{ number_format($car->price_weekly, 0) }}/Weekly</h5>
        </div>
    </div>
</div>
<div class="col-6">
    <div class="row">
        <div class="col-4">
            <div class="blue-icon">
                <img src="{{ asset('front/img/icons/wallet.png') }}" alt="Monthly Price" class="icon-img" />
            </div>
        </div>
        <div class="col-8">
            <h5 class="small">{{ number_format($car->price_monthly, 0) }}/Monthly</h5>
        </div>
    </div>
</div>
<div class="col-6">
    <div class="row">
        <div class="col-4">
            <div class="blue-icon">
                <img src="{{ asset('front/img/icons/calendar.png') }}" alt="Year" class="icon-img" />
            </div>
        </div>
        <div class="col-8">
            <h5 class="small">{{ $car->year }}</h5>
        </div>
    </div>
</div>



</div>

                        <div class="btn-double mt-30" data-grouptype="&amp;">
                            <a data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo" href="#0">Rent Now</a>
                            <a href="https://api.whatsapp.com/send?phone=8551004444" target="_blank"><span class="fa-brands fa-whatsapp"></span> WhatsApp</a>
                        </div>
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
