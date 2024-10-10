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
    <div class="progress-wrap cursor-pointer">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <!-- Logo -->
            <div class="logo-wrapper">
                <a class="logo" href="index.html"> <img src="{{ asset('front/img/white-logo.png') }}" class="logo-img" alt=""> </a>
                <!-- <a class="logo" href="index.html"><h2>Renta<span>x</span></h2></a> -->
            </div>
            <!-- Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"><i class="fa-solid fa-bars"></i></span> </button>
            <!-- Menu -->
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">Home <i class="ti-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="index.html" class="dropdown-item"><span>Slider 01</span></a></li>
                            <li><a href="index5.html" class="dropdown-item"><span>Slider 02</span></a></li>
                            <li><a href="index2.html" class="dropdown-item"><span>Image 01</span></a></li>
                            <li><a href="index7.html" class="dropdown-item"><span>Image 02</span></a></li>
                            <li><a href="index3.html" class="dropdown-item"><span>Video</span></a></li>
                            <li><a href="index4.html" class="dropdown-item"><span>Slideshow</span></a></li>
                            <li><a href="index6.html" class="dropdown-item"><span>Grid Background</span></a></li>
                            <li class="dropdown-submenu dropdown"> <a class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false" href="#"><span>Onepage <i class="ti-angle-right"></i></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="onepage-slider.html" class="dropdown-item"><span>Slider 01</span></a></li>
                                    <li><a href="onepage-slider2.html" class="dropdown-item"><span>Slider 02</span></a></li>
                                    <li><a href="onepage-image.html" class="dropdown-item"><span>Image 01</span></a></li>
                                    <li><a href="onepage-image2.html" class="dropdown-item"><span>Image 02</span></a></li>
                                    <li><a href="onepage-video.html" class="dropdown-item"><span>Video</span></a></li>
                                    <li><a href="onepage-slideshow.html" class="dropdown-item"><span>Slideshow</span></a></li>
                                    <li><a href="onepage-grid-background.html" class="dropdown-item"><span>Grid Background</span></a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
                    <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">Services <i class="ti-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="services.html" class="dropdown-item"><span>Services 01</span></a></li>
                            <li><a href="services2.html" class="dropdown-item"><span>Services 02</span></a></li>
                            <li class="dropdown-submenu dropdown"> <a class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false" href="#"><span>Service Details <i class="ti-angle-right"></i></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="service-details.html" class="dropdown-item"><span>Service Details 01</span></a></li>
                                    <li><a href="service-details2.html" class="dropdown-item"><span>Service Details 02</span></a></li>
                                    <li><a href="service-details3.html" class="dropdown-item"><span>Service Details 03</span></a></li>
                                    <li><a href="service-details4.html" class="dropdown-item"><span>Service Details 04</span></a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown"> <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">Cars <i class="ti-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-submenu dropdown"> <a class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false" href="#"><span>Car Grid <i class="ti-angle-right"></i></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="cars.html" class="dropdown-item"><span>Car Grid 01</span></a></li>
                                    <li><a href="cars2.html" class="dropdown-item"><span>Car Grid 02</span></a></li>
                                    <li><a href="cars3.html" class="dropdown-item"><span>Car Grid 03</span></a></li>
                                </ul>
                            </li>
                            <li><a href="cars4.html" class="dropdown-item"><span>Car Listing</span></a></li>
                            <li class="dropdown-submenu dropdown"> <a class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false" href="#"><span>Car Types <i class="ti-angle-right"></i></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="car-types.html" class="dropdown-item"><span>Car Types 01</span></a></li>
                                    <li><a href="car-types2.html" class="dropdown-item"><span>Car Types 02</span></a></li>
                                    <li><a href="car-types3.html" class="dropdown-item"><span>Car Types 03</span></a></li>
                                    <li><a href="car-types4.html" class="dropdown-item"><span>Car Types 04</span></a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu dropdown"> <a class="dropdown-item active dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false" href="#"><span>Car Details <i class="ti-angle-right"></i></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="car-details.html" class="dropdown-item"><span>Car Details 01</span></a></li>
                                    <li><a href="car-details2.html" class="dropdown-item active"><span>Car Details 02</span></a></li>
                                    <li><a href="car-details3.html" class="dropdown-item"><span>Car Details 03</span></a></li>
                                    <li><a href="car-details4.html" class="dropdown-item"><span>Car Details 04</span></a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">Pages <i class="ti-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="team.html" class="dropdown-item"><span>Team</span></a></li>
                            <li class="dropdown-submenu dropdown"> <a class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false" href="#"><span>Image Gallery <i class="ti-angle-right"></i></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="gallery-image.html" class="dropdown-item"><span>Image Gallery Grid</span></a></li>
                                    <li><a href="gallery-image2.html" class="dropdown-item"><span>Image Gallery Masonry</span></a></li>
                                </ul>
                            </li>
                            <li><a href="gallery-video.html" class="dropdown-item"><span>Video Gallery</span></a></li>
                            <li><a href="price.html" class="dropdown-item"><span>Pricing</span></a></li>
                            <li><a href="faq.html" class="dropdown-item"><span>FAQ</span></a></li>
                            <li><a href="testiominals.html" class="dropdown-item"><span>Testiominals</span></a></li>
                            <li><a href="team-single.html" class="dropdown-item"><span>Team Single</span></a></li>
                            <li><a href="404.html" class="dropdown-item"><span>404 Page</span></a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">Blog <i class="ti-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="blog.html" class="dropdown-item"><span>Blog Grid 01</span></a></li>
                            <li><a href="blog2.html" class="dropdown-item"><span>Blog Grid 02</span></a></li>
                            <li><a href="blog3.html" class="dropdown-item"><span>Blog List</span></a></li>
                            <li><a href="post.html" class="dropdown-item"><span>Post Single</span></a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
                </ul>
                <div class="navbar-right">
                    <div class="wrap">
                        <div class="icon"> <i class="flaticon-phone-call"></i> </div>
                        <div class="text">
                            <p>Need help?</p>
                            <h5><a href="tel:8551004444">855 100 4444</a></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
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
                            <h4>$600 <span>/ rent per day</span></h4>
                        </div>
                        <div class="item">
                            <div class="features"><span><i class="omfi-door"></i> Doors</span>
                                <p>4</p>
                            </div>
                            <div class="features"><span><i class="omfi-passengers"></i> Passengers</span>
                                <p>5</p>
                            </div>
                            <div class="features"><span><i class="omfi-transmission"></i> Transmission</span>
                                <p>Auto</p>
                            </div>
                            <div class="features"><span><i class="omfi-luggage"></i> Luggage</span>
                                <p>2 Bags</p>
                            </div>
                            <div class="features"><span><i class="omfi-condition"></i> Air Condition</span>
                                <p>Yes</p>
                            </div>
                            <div class="features"><span><i class="omfi-age"></i> Age</span>
                                <p>25</p>
                            </div>
                            <div class="btn-double mt-30" data-grouptype="&amp;"> <a data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo" href="#0">Rent Now</a> <a href="https://api.whatsapp.com/send?phone=8551004444" target="_blank"><span class="fa-brands fa-whatsapp"></span> WhatsApp</a> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Lets Talk -->
    <section class="lets-talk bg-img bg-fixed section-padding" data-overlay-dark="5" data-background="img/slider/3.jpg">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h6>Rent Your Car</h6>
                    <h5>Interested in Renting?</h5>
                    <p>Don't hesitate and send us a message.</p> <a href="tel:+8001234567" class="button-1 mt-15 mb-15 mr-10"><i class="fa-brands fa-whatsapp"></i> WhatsApp</a> <a data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo" href="#0" class="button-2 mt-15 mb-15">Rent Now <span class="ti-arrow-top-right"></span></a>
                </div>
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
                            <a href="#0"><img src="img/clients/1.png" alt=""></a>
                        </div>
                        <div class="clients-logo">
                            <a href="#0"><img src="img/clients/2.png" alt=""></a>
                        </div>
                        <div class="clients-logo">
                            <a href="#0"><img src="img/clients/3.png" alt=""></a>
                        </div>
                        <div class="clients-logo">
                            <a href="#0"><img src="img/clients/4.png" alt=""></a>
                        </div>
                        <div class="clients-logo">
                            <a href="#0"><img src="img/clients/5.png" alt=""></a>
                        </div>
                        <div class="clients-logo">
                            <a href="#0"><img src="img/clients/6.png" alt=""></a>
                        </div>
                        <div class="clients-logo">
                            <a href="#0"><img src="img/clients/7.png" alt=""></a>
                        </div>
                        <div class="clients-logo">
                            <a href="#0"><img src="img/clients/8.png" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer -->
    
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