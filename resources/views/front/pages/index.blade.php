@extends('front.layouts.master')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://unpkg.com/sweetalert/dist/sweetalert.css">

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
        </div>
    </header>

    <section class="cars2 section-padding">
        <div class="aha">
            <div class="row">
                <div class="col-4">
                    <div class="section-title">
                        <h2>Our Cars</h2><br>
                        <p>Choose the car that fits your needs</p>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach($cars as $car)
                    <div class="col-md-3 mb-30">
                        <div class="item" style="position: relative;">
                            <img src="{{ asset($car->car_picture) }}" class="img-fluid" alt="">
                            <div class="title">
                                <h4>{{ $car->car_name . ' ' . $car->model }}</h4>
                                <div class="details">
                                    <span><i class="omfi-door"></i> {{ $car->seats }} Seats</span>
                                    <span><i class="omfi-transmission"></i> {{ $car->gear }}</span>
                                    <span><i class="omfi-luggage"></i> {{ $car->bags }} Bags</span>
                                </div>
                                
                                <div class="button-group mt-3">
                                    <button style="background-color: black; color: white; border: 2px solid black;" type="button" class="btn btn-primary reserve-button" data-bs-toggle="modal" data-bs-target="#bookingModal{{ $car->id }}">
                                        Reserve Now
                                    </button>
                                    <a style="background:#018834;border: 2px solid #018834;margin-left:2px;" 
                                    href="https://wa.me/00971542700030?text={{ urlencode("Hello. I am interested in the: " . $car->car_name . ' ' . $car->model . '. See the image here: ' . asset($car->car_picture)) }}" 
                                    class="btn btn-success">WhatsApp</a>
                                </div>
                            </div>

                            <div class="curv-butn icon-bg">
                                <a href="{{ route('cars.show', $car->id) }}" class="vid">
                                    <div class="icon">
                                        <i class="icon-show"><span>AED {{ $car->price_daily }}<br><i>day</i></span></i>
                                        <i class="ti-arrow-top-right icon-hidden"></i>
                                    </div>
                                </a>
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
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>



@endsection
