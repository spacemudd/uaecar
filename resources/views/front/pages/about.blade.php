@extends('front.layouts.master')
@section('content')
    <!-- Preloader -->
    <div class="preloader-bg"></div>
    <div id="preloader">
        <div id="preloader-status">
            <div class="preloader-position loader"> <span></span> </div>
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
            <div class="slogan-container">
            <h3 class="slogan-image">The Right Car For Every Road - Rent Your Way</h3>
        </div>
           
        </div>




        <style>
        .header {
            position: relative;
            overflow: hidden;
            height: 33vh; /* Adjust height as needed */
        }

        .video-fullscreen-wrap {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .video-fullscreen-video {
            min-width: 100%;
            min-height: 100%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 0; /* Send video behind header */
        }

        .slogan-container {
            position: absolute;
            top: 60%;
            right: 11%; /* Position it 20px from the right */
            transform: translateY(-50%); /* Center vertically */
            z-index: 1; /* Ensure the slogan is above the video */
            text-align: center; /* Center the slogan */
        }

        .slogan-image {
            max-width: 100%; /* Responsive image */
            height: auto;
            color: white;
            font-weight: 50;
            font-size: 25px;
        }

        @media (max-width: 768px) {
        .slogan-image {
            display: none; /* Hide image on small screens */
        }
        .slogan-text {
            display: block; /* Show alternative text */
            text-align: center; /* Center text */
        }

        
    }


    @media (max-width: 480px) {
        .slogan-image {
            display: none; /* Hide image on small screens */
        }
        .slogan-text {
            display: block; /* Show alternative text */
            text-align: center; /* Center text */
        }

        
    }
    </style>
    </header>
    <!-- divider line -->
    <div class="line-vr-section"></div>
    <!-- About -->
    <section class="about section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="content">
                        <div class="section-subtitle">LUXURIA</div>
                        <div class="section-title">We Are More Than <span>A Car Rental Company</span></div>
                        <p style="font-size: 15px;">At Luxuria Cars, we are driven to understand our clients'
                        varied needs and provide a tailored range of car rental
                        solutions. Our team of experienced
                        professionals and enthusiastic individuals committed to
                        delivering a smooth experience
                        for our clients.
                        We stand for all-encompassing rental support. Our services
                        include 24-hour roadside
                        assistance, breakdown support, comprehensive rental car
                        insurance, and prompt access
                        to on-site fleet coordinators and technicians for vehicle issues,
                        accident reporting,
                        replacements, and maintenance</p>
                    </div>
                </div>
                <div class="col-md-5 offset-md-1">
                    <div class="item">
                        <img src="{{ asset('front/img/cars/about2.png') }}" class="img-fluid" alt="">
                       
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="about section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="content">
                        <div class="section-title"><span>Our Vision</span></div>
                        <p style="font-size: 15px;">Luxuria Rent a Car aims to be a trailblazer in the
                        UAE car rental industry,
                        representing the pinnacle of high-quality vehicle rentals. With
                        our sights set on an expansive nationwide network and an
                        unwavering commitment to innovation and excellence, we strive
                        to deliver an unmatched rental experience. Safety Rent a Car is
                        determined to set the benchmark and become the gold standard
                        in the regional car rental market through our continuous pursuit
                        of perfection.</p>
                    </div>
                </div>
                <div class="col-md-5 offset-md-1">
                    <div class="item">
                        <img src="{{ asset('front/img/cars/about03.png') }}" class="img-fluid" alt="">
                       
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="about section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="content">
                    <div class="section-title"><span>WHY CHOOSE US?</span></div>
                    <p style="font-size: 15px;">
                        <strong>Customer-Centric Service:</strong> Personalized, attentive service to meet your unique needs. <br>
                        <strong>Diverse Quality Fleet:</strong> A wide range of well-maintained vehicles from economy to luxury. <br>
                        <strong>Flexible Rental Plans:</strong> Customizable options to fit your schedule and requirements. <br>
                        <strong>Transparent Pricing:</strong> Competitive rates with no hidden fees for budget-friendly choices. <br>
                        <strong>Safety and 24/7 Support:</strong> Regularly maintained vehicles and around-the-clock roadside assistance. <br>
                        <strong>Convenient Booking & Locations:</strong> Easy online reservations and strategically located branches for effortless pick-up and drop-off.
                    </p>
                </div>
            </div>
            <div class="col-md-5 offset-md-1">
                    <div class="item">
                        <img src="{{ asset('front/img/cars/about2.png') }}" class="img-fluid" alt="">
                       
                    </div>
                </div>
        </div>
    </div>
</section>


    <!-- Testimonials -->
    <!-- <section class="testimonials section-padding mt-15">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center mb-30">
                    <div class="section-subtitle">Testimonials</div>
                    <div class="section-title">What Clients Say</div>
                </div>
                <div class="col-md-12">
                    <div class="owl-carousel owl-theme">
                        <div class="item">
                            <div class="stars"> <span class="rate">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </span>
                                <div class="shap-left-top">
                                    <svg viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-11 h-11">
                                        <path d="M11 1.54972e-06L0 0L2.38419e-07 11C1.65973e-07 4.92487 4.92487 1.62217e-06 11 1.54972e-06Z" fill="#ffffff"></path>
                                    </svg>
                                </div>
                                <div class="shap-right-bottom">
                                    <svg viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-11 h-11">
                                        <path d="M11 1.54972e-06L0 0L2.38419e-07 11C1.65973e-07 4.92487 4.92487 1.62217e-06 11 1.54972e-06Z" fill="#ffffff"></path>
                                    </svg>
                                </div>
                            </div> <i class="fa-solid fa-quote-left"></i>
                            <div class="text">
                                <p>Lorem posuere in miss drana en the nisan semere sceriun amiss etiam ornare in the miss drana is lorem fermen nunta urnase mauris in the interdum.</p>
                            </div>
                            <div class="info mt-30">
                                <div class="img-curv">
                                    <div class="img"> <img src="{{ asset('front/img/team/1.jpg') }}" alt=""> </div>
                                    <div class="shap-left-top">
                                        <svg viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-11 h-11">
                                            <path d="M11 1.54972e-06L0 0L2.38419e-07 11C1.65973e-07 4.92487 4.92487 1.62217e-06 11 1.54972e-06Z" fill="#ffffff"></path>
                                        </svg>
                                    </div>
                                    <div class="shap-right-bottom">
                                        <svg viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-11 h-11">
                                            <path d="M11 1.54972e-06L0 0L2.38419e-07 11C1.65973e-07 4.92487 4.92487 1.62217e-06 11 1.54972e-06Z" fill="#ffffff"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-30">
                                    <h6>Dan Martin</h6>
                                    <p>Customer</p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="stars"> <span class="rate">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </span>
                                <div class="shap-left-top">
                                    <svg viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-11 h-11">
                                        <path d="M11 1.54972e-06L0 0L2.38419e-07 11C1.65973e-07 4.92487 4.92487 1.62217e-06 11 1.54972e-06Z" fill="#ffffff"></path>
                                    </svg>
                                </div>
                                <div class="shap-right-bottom">
                                    <svg viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-11 h-11">
                                        <path d="M11 1.54972e-06L0 0L2.38419e-07 11C1.65973e-07 4.92487 4.92487 1.62217e-06 11 1.54972e-06Z" fill="#ffffff"></path>
                                    </svg>
                                </div>
                            </div> <i class="fa-solid fa-quote-left"></i>
                            <div class="text">
                                <p>Lorem posuere in miss drana en the nisan semere sceriun amiss etiam ornare in the miss drana is lorem fermen nunta urnase mauris in the interdum.</p>
                            </div>
                            <div class="info mt-30">
                                <div class="img-curv">
                                    <div class="img"> <img src="{{ asset('front/img/team/4.jpg') }}" alt=""> </div>
                                    <div class="shap-left-top">
                                        <svg viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-11 h-11">
                                            <path d="M11 1.54972e-06L0 0L2.38419e-07 11C1.65973e-07 4.92487 4.92487 1.62217e-06 11 1.54972e-06Z" fill="#ffffff"></path>
                                        </svg>
                                    </div>
                                    <div class="shap-right-bottom">
                                        <svg viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-11 h-11">
                                            <path d="M11 1.54972e-06L0 0L2.38419e-07 11C1.65973e-07 4.92487 4.92487 1.62217e-06 11 1.54972e-06Z" fill="#ffffff"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-30">
                                    <h6>Olivia Brown</h6>
                                    <p>Customer</p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="stars"> <span class="rate">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </span>
                                <div class="shap-left-top">
                                    <svg viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-11 h-11">
                                        <path d="M11 1.54972e-06L0 0L2.38419e-07 11C1.65973e-07 4.92487 4.92487 1.62217e-06 11 1.54972e-06Z" fill="#ffffff"></path>
                                    </svg>
                                </div>
                                <div class="shap-right-bottom">
                                    <svg viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-11 h-11">
                                        <path d="M11 1.54972e-06L0 0L2.38419e-07 11C1.65973e-07 4.92487 4.92487 1.62217e-06 11 1.54972e-06Z" fill="#ffffff"></path>
                                    </svg>
                                </div>
                            </div> <i class="fa-solid fa-quote-left"></i>
                            <div class="text">
                                <p>Lorem posuere in miss drana en the nisan semere sceriun amiss etiam ornare in the miss drana is lorem fermen nunta urnase mauris in the interdum.</p>
                            </div>
                            <div class="info mt-30">
                                <div class="img-curv">
                                    <div class="img"> <img src="{{ asset('front/img/team/6.jpg') }}" alt=""> </div>
                                    <div class="shap-left-top">
                                        <svg viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-11 h-11">
                                            <path d="M11 1.54972e-06L0 0L2.38419e-07 11C1.65973e-07 4.92487 4.92487 1.62217e-06 11 1.54972e-06Z" fill="#ffffff"></path>
                                        </svg>
                                    </div>
                                    <div class="shap-right-bottom">
                                        <svg viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-11 h-11">
                                            <path d="M11 1.54972e-06L0 0L2.38419e-07 11C1.65973e-07 4.92487 4.92487 1.62217e-06 11 1.54972e-06Z" fill="#ffffff"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-30">
                                    <h6>Emily Martin</h6>
                                    <p>Customer</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- divider line -->
    <div class="line-vr-section"></div>

    <!-- Lets Talk -->
    <section class="lets-talk bg-img bg-fixed section-padding" data-overlay-dark="5" data-background="{{ asset('front/img/slider/3.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h6>Rent Your Car</h6>
                    <h5>Interested in Renting?</h5>
                    <p>Don't hesitate and send us a message.</p> 
                    <a href="https://wa.me/971542700030" class="button-1 mt-15 mb-15 mr-10"><i class="fa-brands fa-whatsapp"></i> WhatsApp</a> 
                    <!-- <a data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo" href="#" class="button-2 mt-15 mb-15">Rent Now <span class="ti-arrow-top-right"></span></a> -->
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
@endsection
