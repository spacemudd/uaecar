@extends('front.layouts.master')


@section('content')
    <!-- Preloader -->
    <div class="preloader-bg"></div>
    <div id="preloader">
        <div id="preloader-status">
            <div class="preloader-position loader"> <span></span> </div>
        </div>
    </div>


    <!-- Header Inner Slider -->
    <header class="header slider">
        <div class="owl-carousel owl-theme">
            <!-- The opacity on the image is made with "data-overlay-dark="number". You can change it using the numbers 0-9. -->
            <div class="text-center item bg-img" data-overlay-dark="4" data-background="{{ asset('front/img/slider/1.jpg') }}"></div>
        </div>
    </header>
    <!-- Details -->
    <section class="car-details section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="row mb-60">
                        <div class="col-md-12">
                            <h1>{{ $car->car_name }}</h1>
                            <h3>General Information</h3>
                            <p class="mb-30">Lorem pretium fermentum quam, sit amet cursus ante sollicitudin velen morbi consesua the miss sustion consation porttitor orci sit amet iaculis nisan. Lorem pretium fermentum quam sit amet cursus ante sollicitudin velen fermen morbinetion consesua the risus consequation the porttiton.</p>
                            <ul class="list-unstyled list">
                                <li>
                                    <div class="list-icon"> <span class="ti-check"></span> </div>
                                    <div class="list-text">
                                        <p>24/7 Roadside Assistance</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="list-icon"> <span class="ti-check"></span> </div>
                                    <div class="list-text">
                                        <p>Free Cancellation & Return</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="list-icon"> <span class="ti-check"></span> </div>
                                    <div class="list-text">
                                        <p>Rent Now Pay When You Arrive</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--  Gallery Image -->
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Image Gallery</h3>
                        </div>
                    </div>
                    <div class="row gallery-items mb-60">
                        <div class="col-md-4 gallery-masonry-wrapper single-item cardio">
                            <a href="img/cars/c7.jpg" title="" class="gallery-masonry-item-img-link img-zoom">
                                <div class="gallery-box">
                                    <div class="gallery-img"> <img src="img/cars/c7.jpg" class="img-fluid mx-auto d-block" alt=""> </div>
                                    <div class="gallery-masonry-item-img"></div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 gallery-masonry-wrapper single-item crossfit">
                            <a href="img/cars/c8.jpg" title="" class="gallery-masonry-item-img-link img-zoom">
                                <div class="gallery-box">
                                    <div class="gallery-img"> <img src="img/cars/c8.jpg" class="img-fluid mx-auto d-block" alt=""> </div>
                                    <div class="gallery-masonry-item-img"></div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 gallery-masonry-wrapper single-item crossfit">
                            <a href="img/cars/c9.jpg" title="" class="gallery-masonry-item-img-link img-zoom">
                                <div class="gallery-box">
                                    <div class="gallery-img"> <img src="img/cars/c9.jpg" class="img-fluid mx-auto d-block" alt=""> </div>
                                    <div class="gallery-masonry-item-img"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!-- FAQs -->
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Rental Conditions</h3>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <ul class="accordion-box clearfix">
                                <li class="accordion block">
                                    <div class="acc-btn"><span class="count">1.</span> Contract and Annexes</div>
                                    <div class="acc-content">
                                        <div class="content">
                                            <div class="text">In addition to the car rental contract to be signed at the time of delivery, a credit card is required from our individual customers. We request our commercial customers to submit their company documents (tax plate, signature slip, ID photocopy).</div>
                                        </div>
                                    </div>
                                </li>
                                <li class="accordion block">
                                    <div class="acc-btn"><span class="count">2.</span> Driving License and Age</div>
                                    <div class="acc-content">
                                        <div class="content">
                                            <div class="text">The tenant must be 25 years of age and have a 5-year local or valid international driver's license for group A, B, C, D vehicles at the time of the rental agreement.</div>
                                        </div>
                                    </div>
                                </li>
                                <li class="accordion block">
                                    <div class="acc-btn"><span class="count">3.</span> Prices</div>
                                    <div class="acc-content">
                                        <div class="content">
                                            <div class="text">Prices include maintenance and insurance guarantee against third parties (within legal policy limits). 18% VAT (value added tax) is not included. Fuel belongs to the renter. Chauffeur driven service and translator guide are available upon request.</div>
                                        </div>
                                    </div>
                                </li>
                                <li class="accordion block">
                                    <div class="acc-btn"><span class="count">4.</span> Payments</div>
                                    <div class="acc-content">
                                        <div class="content">
                                            <div class="text">The total rental fee is collected at the time of rental. The shortest rental period is 72 hours, and in case of delay, 1/3 of the fee is charged for each additional hour. Delays exceeding 3 hours in total are calculated as a full day. A deposit is required from a valid credit card.</div>
                                        </div>
                                    </div>
                                </li>
                                <li class="accordion block">
                                    <div class="acc-btn"><span class="count">5.</span> Delivery</div>
                                    <div class="acc-content">
                                        <div class="content">
                                            <div class="text">Delivery is free of charge where our Rent a car company is located. Delivery in these cities is possible with prior notice; hotel, workplace, station, port etc. It can be done in places. For vehicle deliveries and returns in cities where our office is not located, a delivery fee of 0.2 Euro/km is applied, starting from the rented location.</div>
                                        </div>
                                    </div>
                                </li>
                                <li class="accordion block">
                                    <div class="acc-btn"><span class="count">6.</span> Traffic Fines</div>
                                    <div class="acc-content">
                                        <div class="content">
                                            <div class="text">Traffic fines toll and illegal toll fees belong to the customer. If the vehicles are detained by traffic, this period is included in the rental period. In necessary cases, we may change these conditions and information and the vehicle type specified in the reservation without prior notice. Our vehicles cannot be taken abroad.</div>
                                        </div>
                                    </div>
                                </li>
                                <li class="accordion block">
                                    <div class="acc-btn"><span class="count">7.</span> Contract and Annexes</div>
                                    <div class="acc-content">
                                        <div class="content">
                                            <div class="text">In addition to the car rental contract to be signed at the time of delivery, a credit card is required from our individual customers. We request our commercial customers to submit their company documents (tax plate, signature slip, ID photocopy).</div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Sidebar -->
                <div class="col-lg-4 col-md-12">
                    <div class="sidebar-car">
                        <div class="title">
                            <h4>AED {{ $car->price }} <span>/ rent per day</span></h4>
                        </div>
                        <div class="item">
                            <div class="features"><span><i class="omfi-door"></i> Doors</span>
                                <p>{{ $car->doors}}</p>
                            </div>
                            <div class="features"><span><i class="omfi-passengers"></i> Passengers</span>
                                <p>{{ $car->passengers }}</p>
                            </div>
                            <div class="features"><span><i class="omfi-transmission"></i> Transmission</span>
                                <p>{{ $car->gear }}</p>
                            </div>
                            <div class="features"><span><i class="omfi-luggage"></i> Luggage</span>
                                <p>2 {{ $car->bags }}</p>
                            </div>
                            <div class="features"><span><i class="omfi-condition"></i> Air Condition</span>
                                <p>{{$car->air_condition}}</p>
                            </div>
                            <div class="features"><span><i class="omfi-age"></i> Age</span>
                                <p>{{ $car->apache_get_modules }}</p>
                            </div>
                            <div class="btn-double mt-30" data-grouptype="&amp;"> <a data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo" href="#0">Rent Now</a> <a href="https://api.whatsapp.com/send?phone=8551004444" target="_blank"><span class="fa-brands fa-whatsapp"></span> WhatsApp</a> </div>
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