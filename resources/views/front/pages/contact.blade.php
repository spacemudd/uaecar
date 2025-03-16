@extends('front.layouts.master')
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-11504797989"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'AW-11504797989');
</script>




@section('content')
<body class="bg-gray">
    <!-- Preloader -->
    <div class="preloader-bg"></div>
    <div id="preloader">
        <div id="preloader-status">
            <div class="preloader-position loader"> <span></span> </div>
        </div>
    </div>

    <!-- Header Banner -->
    <header class="header">
        <div class="video-fullscreen-wrap">
            
            <div class="video-fullscreen-video" data-overlay-dark="2">
                <video playsinline autoplay loop muted>
                    <source src="https://duruthemes.com/demo/html/renax/video.mp4" type="video/mp4">
                    <source src="https://duruthemes.com/demo/html/renax/video.webm" type="video/webm">
                </video>
            </div>
            <div class="slogan-container">
            <h3 class="slogan-image" style="font-family: 'Calisto MT', serif;">The Right Car For Every Road - Rent Your Way</h3>
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
                        right: 15%;
                        transform: translateY(-50%);
                        z-index: 1;
                        text-align: center;
                        }


                        .slogan-image {
                            max-width: 100%;
                            height: auto;
                            color: white;
                            font-weight: 50;
                            font-size: 18px;
                            margin-right: 0;
                            }

                @media (max-width: 768px) {

                .slogan-text {
                    display: block; /* Show alternative text */
                    text-align: center; /* Center text */
                }

                
            }


            @media (max-width: 480px) {
              

                .slogan-image {
                    max-width: 100%; /* Responsive image */
                    height: auto;
                    color: white;
                    font-weight: 50;
                    font-size: 15px;
                    text-align: center;
                }
            
                .slogan-text {
                    font-size: 20px;
                    text-align: center; /* Center text */
                }

                
            }
        </style>
    </header>
    <!-- Contact Box -->
    <div class="contact-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 animate-box" data-animate-effect="fadeInUp">
                    <div class="item"> <span class="icon omfi-envelope"></span>
                        <h5 style="font-family: 'Calisto MT', serif;">Email us</h5>
                        <p style="font-family: 'Calisto MT', serif;">info@rentluxuria.com</p> <i class="numb omfi-envelope"></i>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 animate-box" data-animate-effect="fadeInUp">
                    <div class="item"> <span class="icon omfi-location"></span>
                        <h5 style="font-family: 'Calisto MT', serif;">Our address</h5>
                        <p style="font-family: 'Calisto MT', serif;">Address 1- Shop No 9 - Dr Murad Building - Hor Al Anz East - Abu Hail - Dubai - UAE</p> <i class="numb omfi-location"></i><br>
                        <p class="mb-0" style="font-family: 'Calisto MT', serif;">Address 2- Al Rashidiya 3 - Ajman - United Arab Emirates</p>

                    </div>
                </div>
                <div class="col-lg-3 col-md-6 animate-box" data-animate-effect="fadeInUp">
                    <div class="item"> <span class="icon ti-time"></span>
                        <h5 style="font-family: 'Calisto MT', serif;">Opening Hours</h5>
                        <p style="font-family: 'Calisto MT', serif;">10:00 AM - 10:00 PM</p> <i class="numb ti-time"></i>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 animate-box" data-animate-effect="fadeInUp">
                    <div class="item active"> <span class="icon omfi-phone"></span>
                        <h5 style="font-family: 'Calisto MT', serif;">Call us</h5>
                        <p style="font-family: 'Calisto MT', serif;">+971502711549</p> <i class="numb omfi-phone"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact -->
    <section class="contact section-padding">
        <div class="container">
            <div class="row">
                <!-- Form -->
                <div class="col-lg-6 col-md-12 mb-30">
                    <div class="form-box">
                        <h5 style="font-family: 'Calisto MT', serif;">Get in touch</h5>
                        <form method="post" class="contact__form" action="{{ route('form.contact') }}">

                        @csrf 
                            <!-- form message -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="alert alert-success contact__msg" style="display: none; font-family: 'Calisto MT', serif;" role="alert"> Your message was sent successfully. </div>
                                </div>
                            </div>
                            <!-- form elements -->
                            <div class="row">
                                <div class="col-md-6 form-group" >
                                    <input name="name" type="text" placeholder="Your Name *" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input name="email" type="email" placeholder="Your Email *" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input name="phone" type="text" placeholder="Your Number *" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input name="subject" type="text" placeholder="Subject *" required>
                                </div>
                                <div class="col-md-12 form-group">
                                    <textarea name="message" id="message" cols="30" rows="4" placeholder="Message *" required></textarea>
                                </div>
                                <div class="col-md-12" style="font-family: 'Calisto MT', serif;">
                                    <input name="submit" type="submit" value="Send Message">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Map -->
                <div class="col-lg-5 offset-lg-1 col-md-12">
                    <h5>Location</h5>
                    <div class="google-map">
                        <!-- Wrap the iframe inside an anchor tag pointing to the Google Maps link -->
                        <a href="https://www.google.com/maps/place/Luxuria+Cars+Rental/@25.3982346,55.4403971,64m/data=!3m1!1e3!4m6!3m5!1s0x3e5f596a8e876377:0x26f89404dd87b493!8m2!3d25.3982362!4d55.4404803!16s%2Fg%2F11wj48l2kp?entry=ttu&g_ep=EgoyMDI0MTAxNi4wIKXMDSoASAFQAw%3D%3D" target="_blank" style="display: block; width: 100%; height: 100%;">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d273.36515892157473!2d55.4403971!3d25.3982346!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f596a8e876377%3A0x26f89404dd87b493!2sLuxuria%20Cars%20Rental!5e1!3m2!1sar!2ssa!4v1730029981917!5m2!1sar!2ssa" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </a>
                    </div>
                </div>


        </div>
    </section>
    <!-- Lets Talk -->
    <section class="lets-talk bg-img bg-fixed section-padding" data-overlay-dark="6" data-background="{{ asset('front/img/slider/3.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h6>Rent Your Car</h6>
                    <h5 style="font-family: 'Calisto MT', serif;">Interested in Renting?</h5>
                    <p style="font-family: 'Calisto MT', serif;">Don't hesitate and send us a message.</p> <a href="tel:+8001234567" class="button-1 mt-15 mb-15 mr-10"><i class="fa-brands fa-whatsapp"></i> WhatsApp</a> <a data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo" href="#0" class="button-2 mt-15 mb-15">Rent Now <span class="ti-arrow-top-right"></span></a>
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