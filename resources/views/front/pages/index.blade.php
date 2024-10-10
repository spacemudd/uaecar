<!-- resources/views/home.blade.php -->
@extends('front.layouts.master')

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
                            <h4>{{ $car->car_name }}</h4> <!-- Display the car name -->
                            <div class="details">
                                <span><i class="omfi-door"></i> {{ $car->seats }} Seats</span>
                                <span><i class="omfi-transmission"></i> {{ $car->gear }}</span>
                                <span><i class="omfi-luggage"></i> {{ $car->bags }} Bags</span>
                            </div>
                            <div class="button-group mt-3">
                                <a href="#" class="btn btn-primary">Reserve</a>
                                <a href="#" class="btn btn-success">WhatsApp</a>
                            </div>
                        </div>
                        <div class="curv-butn icon-bg">
                            <a href="{{ route('cars.show', $car->id) }}" class="vid">
                                <div class="icon"> 
                                    <i class="icon-show"><span>${{ $car->price }}<br><i>day</i></span></i>
                                    <i class="ti-arrow-top-right icon-hidden"></i> 
                                </div>
                            </a>
                            <div class="br-left-top">
                                <svg viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-11 h-11">
                                    <path d="M11 1.54972e-06L0 0L2.38419e-07 11C1.65973e-07 4.92487 4.92487 1.62217e-06 11 1.54972e-06Z" fill="#ffffff"></path>
                                </svg>
                            </div>
                            <div class="br-right-bottom">
                                <svg viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-11 h-11">
                                    <path d="M11 1.54972e-06L0 0L2.38419e-07 11C1.65973e-07 4.92487 4.92487 1.62217e-06 11 1.54972e-06Z" fill="#ffffff"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>



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

@endsection