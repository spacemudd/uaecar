<!-- resources/views/home.blade.php -->
@extends('front.layouts.master')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@section('content')
    <!-- Preloader -->
    <div class="preloader-bg"></div>
    <div id="preloader">
        <div id="preloader-status">
            <div class="preloader-position loader"> <span></span> </div>
        </div>
    </div>
    <!-- Progress scroll totop -->
    <!-- <div class="progress-wrap cursor-pointer">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div> -->
  
    <!-- Header Video -->
    <header class="header">
    <div class="video-fullscreen-wrap">
        <div class="video-fullscreen-video" data-overlay-dark="2">
            <video playsinline="" autoplay="" loop="" muted="">
                <source src="https://duruthemes.com/demo/html/renax/video.mp4" type="video/mp4">
                <source src="https://duruthemes.com/demo/html/renax/video.webm" type="video/webm">
                
            </video>
        </div>
        <!-- Book -->
            <!-- <div class="v-middle">
                <div class="container">
                    <div class="booking-inner clearfix">
                        <form action="#0" class="form1 brdr clearfix">
                        <div class="col2 c3">
                            <div class="select1_wrapper">
                                <label>Choose Car Type</label>
                                <div class="select1_inner">
                                    <select class="select2 select" style="width: 100%">
                                        <option value="0">Choose Car Type</option>
                                        <option value="1">All</option>
                                        <option value="2">Luxury Cars</option>
                                        <option value="3">Sport Cars</option>
                                        <option value="4">SUVs</option>
                                        <option value="5">Convertible</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col2 c4">
                            <div class="select1_wrapper">
                                <label>Pick Up Location</label>
                                <div class="select1_inner">
                                    <select class="select2 select" style="width: 100%">
                                        <option value="0">Pick Up Location</option>
                                        <option value="1">Dubai</option>
                                        <option value="2">Abu Dhabi</option>
                                        <option value="3">Sharjah</option>
                                        <option value="4">Alain</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col1 c1">
                            <div class="input1_wrapper">
                                <label>Pick Up Date</label>
                                <div class="input1_inner">
                                    <input type="text" class="form-control input datepicker" placeholder="Pick Up Date" required>
                                </div>
                            </div>
                        </div>
                        <div class="col2 c5">
                            <div class="select1_wrapper">
                                <label>Drop Off Location</label>
                                <div class="select1_inner">
                                    <select class="select2 select" style="width: 100%">
                                        <option value="0">Drop Off Location</option>
                                        <option value="1">Alain</option>
                                        <option value="2">Sharjah</option>
                                        <option value="3">Abu Dhabi</option>
                                        <option value="4">Dubai</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col1 c2">
                            <div class="input1_wrapper">
                                <label>Return Date</label>
                                <div class="input1_inner">
                                    <input type="text" class="form-control input datepicker" placeholder="Return Date">
                                </div>
                            </div>
                        </div>
                        <div class="col3 c6">
                            <button type="submit" class="booking-button">Rent Now</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div> -->
        </div>

          <!-- Clients -->
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
                    </div>
                </div>
            </div>
        </div>
    </section>
    </header>

    
    <!-- Cars List -->
    <section class="cars2 section-padding">
    <div class="container">
        <div class="row">
            @foreach($cars as $car)
                <div class="col-md-4 mb-30">
                    <div class="item"> 
                        <img src="{{ asset($car->car_picture) }}" class="img-fluid" alt="">
                        <div class="bottom-fade"></div>
                        <div class="title">
                            <h4>{{ $car->car_name }}</h4>
                            <div class="details">
                                <span><i class="omfi-door"></i> {{ $car->seats }} Seats</span>
                                <span><i class="omfi-transmission"></i> {{ $car->gear }}</span>
                                <span><i class="omfi-luggage"></i> {{ $car->bags }} Bags</span>
                            </div>
                            <div class="button-group mt-3">
                                <button type="button" class="btn btn-primary reserve-button" data-bs-toggle="modal" data-bs-target="#bookingModal{{ $car->id }}">
                                    Book Now
                                </button>
                                <a href="https://wa.me/00971542700030" class="btn btn-success">WhatsApp</a>
                            </div>
                        </div>
                        <div class="curv-butn icon-bg">
                            <a href="{{ route('cars.show', $car->id) }}" class="vid">
                                <div class="icon"> 
                                    <i class="icon-show"><span>AED {{ $car->price }}<br><i>day</i></span></i>
                                    <i class="ti-arrow-top-right icon-hidden"></i> 
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Booking Modal for Each Car -->
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
                                    <form method="post" action="{{ route('form.submit') }}" class="form1 contact__form clearfix">
                                    @csrf <!-- Add CSRF token for security -->

                                    <!-- Hidden input for car_id -->
                                    <input type="hidden" name="car_id" id="car_id">

                                    <!-- form message -->
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="alert alert-success contact__msg" style="display: none" role="alert"> Your message was sent successfully. </div>
                                        </div>
                                    </div>

                                    <!-- form elements -->
                                    <div class="row">
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
                                                <label>Pick Up City</label>
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




  

    <!-- RentNow Popup -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Booking Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="booking-box">
                        <div class="booking-inner clearfix">
                            <form method="post" action="#0" class="form1 contact__form clearfix">
                                <!-- form message -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="alert alert-success contact__msg" style="display: none" role="alert"> Your message was sent successfully. </div>
                                    </div>
                                </div>
                                <!-- form elements -->
                                <div class="row">
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
                                            <label>Choose Car Type</label>
                                            <div class="select1_inner">
                                                <select class="select2 select" style="width: 100%">
                                                    <option value="0">Choose Car Type</option>
                                                    <option value="1">All</option>
                                                    <option value="2">Luxury Cars</option>
                                                    <option value="3">Sport Cars</option>
                                                    <option value="4">SUVs</option>
                                                    <option value="5">Convertible</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="select1_wrapper">
                                            <label>Pick Up Location</label>
                                            <div class="select1_inner">
                                                <select class="select2 select" style="width: 100%">
                                                    <option value="0">Pick Up Location</option>
                                                    <option value="1">Dubai</option>
                                                    <option value="2">Abu Dhabi</option>
                                                    <option value="3">Sharjah</option>
                                                    <option value="4">Alain</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="input1_wrapper">
                                            <label>Pick Up Date</label>
                                            <div class="input1_inner">
                                                <input type="text" class="form-control input datepicker" placeholder="Pick Up Date" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="select1_wrapper">
                                            <label>Drop Off Location</label>
                                            <div class="select1_inner">
                                                <select class="select2 select" style="width: 100%">
                                                    <option value="0">Drop Off Location</option>
                                                    <option value="1">Alain</option>
                                                    <option value="2">Sharjah</option>
                                                    <option value="3">Abu Dhabi</option>
                                                    <option value="4">Dubai</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="input1_wrapper">
                                            <label>Return Date</label>
                                            <div class="input1_inner">
                                                <input type="text" class="form-control input datepicker" placeholder="Return Date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 form-group">
                                        <textarea name="message" id="message" cols="30" rows="4" placeholder="Additional Note"></textarea>
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

<!-- Check for session message outside the modal loop -->
@if (Session::has('message'))
    <script>
        Swal.fire({
            title: 'Success!',
            text: "{{ Session::get('message') }}",
            icon: 'success',
            confirmButtonText: 'OK'
        });
    </script>
@endif
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    $(document).ready(function() {
        $('.select2').select2({
            minimumResultsForSearch: Infinity // Optional: hides search box
        });
    });
    function setCarId(carId) {
    document.getElementById('car_id').value = carId;
    // Optionally, open the booking form/modal here if needed
    }
    </script>

    


@endsection