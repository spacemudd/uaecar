@extends('front.layouts.master')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://unpkg.com/sweetalert/dist/sweetalert.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

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


    $(document).ready(function(){
    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        autoplay: true,
        autoplayTimeout: 4000, // الوقت بين الشرائح
        autoplayHoverPause: false, // استمر في الحركة عند التمرير
        smartSpeed: 10000, // سرعة الحركة
        responsive: {
            0: {
                items: 1
            },
            100: {
                items: 3
            },
            500: {
                items: 5
            }
        }
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
        <div class="slogan" style="max-width: 400px; text-align: right; font-size: 0.9rem; color: #fff; margin-top: 10px;">
            The Right Car for Every Road – Rent Your Way
        </div>

            <style>
                @media (max-width: 600px) { /* Adjust the width as needed */
                    .slogan {
                        display: none;
                    }
                }
            </style>
    </header>


    <section class="clients">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="owl-carousel owl-theme">
                        <div class="clients-logo">
                            <a href="#0"><img src="{{ asset('front/img/clients/1.png') }}" alt=""></a>
                        </div>
                        <div class="clients-logo">
                            <a href="#0"><img src="{{ asset('front/img/clients/2.png') }}" alt=""></a>
                        </div>
                        <div class="clients-logo">
                            <a href="#0"><img src="{{ asset('front/img/clients/3.png') }}" alt=""></a>
                        </div>
                        <div class="clients-logo">
                            <a href="#0"><img src="{{ asset('front/img/clients/4.png') }}" alt=""></a>
                        </div>
                        <div class="clients-logo">
                            <a href="#0"><img src="{{ asset('front/img/clients/5.png') }}" alt=""></a>
                        </div>
                        <div class="clients-logo">
                            <a href="#0"><img src="{{ asset('front/img/clients/6.png') }}" alt=""></a>
                        </div>
                        <div class="clients-logo">
                            <a href="#0"><img src="{{ asset('front/img/clients/7.png') }}" alt=""></a>
                        </div>
                        <div class="clients-logo">
                            <a href="#0"><img src="{{ asset('front/img/clients/8.png') }}" alt=""></a>
                        </div>
                        <div class="clients-logo">
                            <a href="#0"><img src="{{ asset('front/img/clients/9.png') }}" alt=""></a>
                        </div>
                        <div class="clients-logo">
                            <a href="#0"><img src="{{ asset('front/img/clients/10.png') }}" alt=""></a>
                        </div>
                        <div class="clients-logo">
                            <a href="#0"><img src="{{ asset('front/img/clients/11.png') }}" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="cars2 section-padding my-0 py-0">
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
 

                <a href="{{ route('cars.show', $car->id) }}" class="card3" style="text-decoration: none;">
    <span class="px-3 py-2" style="display: inline-block;">
        <h3 class="car_name" style="display: inline-block; margin: 0;">{{ $car->car_name . ' ' . $car->model}}</h3> 
        <br>
        <h4 class="car_name" style="display:inline-block; margin:0;">{{ $car->year }}</h4>
        <!-- <span class="car_mini_text" style="display: inline-block;">or similar</span> -->
    </span>
    <div>   
        
        <!-- <p class="px-3">Mini Sedan Automatic</p> -->
    </div>
   
    <div class="span-group px-3" style="font-size: 12px;">
        <span>{{$car->seats . ' Seats' }}</span>
        <span>{{$car->doors . ' Doors'}}</span>
        <span>Automatic</span>
    </div>
    <div>
        <img src="{{ $car->car_picture }}" alt="">
    </div>

    <div class="d-flex mt-3">
        <div>
            <span class="px-3 py-2" style="display: inline-block;">
                <!-- <span style="display: inline-block;">*</span> -->
                <!-- <p class="car_name" style="display: inline-block; margin: 0;">1,000 kilometers included</p>  -->
            </span>
            
            <div style="margin-left: 65px; margin-top: -59px; display: flex; justify-content: center; align-items: flex-start;">
    <div style="padding-right: 38px; margin: 0; display: flex; flex-direction: column; align-items: center;">
        <h5 class="car_name" style="margin: 0;">Daily</h5>
        <span class="price" style="font-size: 22px;">{{ number_format($car->price_daily, 0) }} AED</span>
    </div>

    <div style="padding-right: 33px;padding-left: 11%;margin: 0;display: flex;flex-direction: column;align-items: center;padding-bottom: 11%;">
        <h5 class="car_name" style="margin: 0;">Weekly</h5>
        <span class="price" style="font-size: 22px;">5,000 AED</span>
    </div>

    <div style="margin: 0; display: flex; flex-direction: column; align-items: center;">
        <h5 class="car_name" style="margin: 0;">Monthly</h5>
        <span class="price" style="font-size: 22px;">{{ number_format($car->price_monthly, 0) }} AED</span>
    </div>
</div>










                <!-- <span class="text-secondary" style="display: inline-block; color: white;"> SAR 518.19 total</span> -->
                
            </span>
            <button style="background-color: #767676; color: white; border: 2px solid #767676; margin: 0 35px 0 22px;" 
                type="button" 
                class="btn btn-primary reserve-button py-1 my-2" 
                data-bs-toggle="modal" 
                data-bs-target="#bookingModal{{ $car->id }}"
                onclick="openBookingModal(event);">
            Book Now
        </button>
        </div>
       
        <div class="px-3">   
            <span class="whatsapp-icon">
                <i class="fab fa-whatsapp"></i>
            </span>
        </div>
    </div>
</a>

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
