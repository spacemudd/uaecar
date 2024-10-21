<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>LUXURIA</title>
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap">
    <link rel="stylesheet" href="{{ asset('front/css/plugins.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}" />

</head>
<body>

<nav class="navbar navbar-expand-lg">
        <div class="container">
            <!-- Logo -->
            <div class="logo-container" style="position: absolute; top:140%; transform:translateY(-50%)">
                <a href="{{ route('index') }}"> <img src="{{ asset('front/img/white-logo.png') }}" class="logo-img" alt=""> </a>
                <!-- <a class="logo" href="index.html"><h2>Renta<span>x</span></h2></a> -->
            </div>
            <!-- Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"><i class="fa-solid fa-bars"></i></span> </button>
            <!-- Menu -->
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('index') }}">Home</a></li>

                    <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About</a></li>

                    <!-- <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">Cars <i class="ti-angle-down"></i></a>
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
                            <li class="dropdown-submenu dropdown"> <a class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false" href="#"><span>Car Details <i class="ti-angle-right"></i></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="car-details.html" class="dropdown-item"><span>Car Details 01</span></a></li>
                                    <li><a href="car-details2.html" class="dropdown-item"><span>Car Details 02</span></a></li>
                                    <li><a href="car-details3.html" class="dropdown-item"><span>Car Details 03</span></a></li>
                                    <li><a href="car-details4.html" class="dropdown-item"><span>Car Details 04</span></a></li>
                                </ul>
                            </li>
                        </ul>
                    </li> -->


                <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>

                </ul>
                <div class="navbar-right">
                    <div class="wrap">
                        <div class="icon"> <i class="flaticon-phone-call"></i> </div>
                        <div class="text">
                            <p>Need help?</p>
                            <h5><a href="tel:+971542700030">05 4270 0030</a></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    @yield('content')



        <!-- Footer -->
        <footer class="footer clearfix">
        <div class="container">
            <!-- first footer -->
            <div class="first-footer">
                <div class="row">
                    <div class="col-md-12">
                        <div class="links dark footer-contact-links">
                            <div class="footer-contact-links-wrapper">
                                <div class="footer-contact-link-wrapper">
                                    <div class="image-wrapper footer-contact-link-icon">
                                        <div class="icon-footer"> <i class="flaticon-phone-call"></i> </div>
                                    </div>
                                    <div class="footer-contact-link-content">
                                        <h6>Call us</h6>
                                        <p>+971 54-270-0030</p>
                                    </div>
                                </div>
                                <div class="footer-contact-links-divider"></div>
                                <div class="footer-contact-link-wrapper">
                                    <div class="image-wrapper footer-contact-link-icon">
                                        <div class="icon-footer"> <i class="omfi-envelope"></i> </div>
                                    </div>
                                    <div class="footer-contact-link-content">
                                        <h6>Write to us</h6>
                                        <p>info@rentluxuria.com</p>
                                    </div>
                                </div>
                                <div class="footer-contact-links-divider"></div>
                                <div class="footer-contact-link-wrapper">
                                    <div class="image-wrapper footer-contact-link-icon">
                                        <div class="icon-footer"> <i class="omfi-location"></i> </div>
                                    </div>
                                    <div class="footer-contact-link-content">
                                        <h6>Address</h6>
                                        <p>Al Rashidiya 3 - Ajman - United Arab Emirates</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- second footer -->
            <div class="second-footer">
                <div class="row">
                    <!-- about & social icons -->
                    <div class="col-md-4 widget-area">
                        <div class="widget clearfix">
                            <div class="footer-logo"><img src="{{ asset('front/img/white-logo.png') }}" alt=""></div>
                            <!-- <div class="footer-logo"><h2>CARE<span>X</span></h2></div> -->
                            <div class="widget-text">
                                <p>Rent a car imperdiet sapien porttito the bibenum ellentesue the commodo erat nesuen.</p>
                                <div class="social-icons">
                                    <ul class="list-inline">
                                        <li><a href="https://wa.me/971542700030"><i class="fa-brands fa-whatsapp"></i></a></li>
                                        <li><a href="https://www.facebook.com/profile.php?id=61566173455254&mibextid=JRoKGi"><i class="fa-brands fa-facebook-f"></i></a></li>
                                        <li><a href="https://www.instagram.com/luxuria_uae?igsh=MTYwNDNwcW9vNDV1Zw=="><i class="fa-brands fa-instagram"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- quick links -->
                    <div class="col-md-3 offset-md-1 widget-area">
                        <div class="widget clearfix usful-links">
                            <h3 class="widget-title">Quick Links</h3>
                            <ul>
                                <li><a href="{{ route('index') }}">Home</a></li>
                                <li><a href="{{ route('about') }}">About</a></li>
                                <!-- <li><a href="car-types.html">Cars Types</a></li> -->
                                <li><a href="{{ route('contact') }}">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- subscribe -->
                    <div class="col-md-4 widget-area">
                        <div class="widget clearfix">
                            <h3 class="widget-title">Subscribe</h3>
                            <p>Want to be notified about our services. Just sign up and we'll send you a notification by email.</p>
                            <div class="widget-newsletter">
                                <form action="#">
                                    <input type="email" placeholder="Email Address" required>
                                    <button type="submit"><i class="ti-arrow-top-right"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- bottom footer -->
            <div class="bottom-footer-text">
                <div class="row copyright">
                    <div class="col-md-12">
                        <p class="mb-0">&copy;2024 <a href="#">Luxuria</a>. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
        </footer>
        <a href="https://wa.me/971542700030" class="whatsapp-button" target="_blank">
          <img src="{{ asset('front/img/whatsapp-svgrepo-com.svg')}}" alt="WhatsApp" />
        </a>
    <!-- jQuery -->
    <script src="{{ asset('front/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('front/js/jquery-migrate-3.4.1.min.js') }}"></script>
    <script src="{{ asset('front/js/modernizr-2.6.2.min.js') }}"></script>
    <script src="{{ asset('front/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('front/js/jquery.isotope.v3.0.2.js') }}"></script>
    <script src="{{ asset('front/js/popper.min.js') }}"></script>
    <script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('front/js/scrollIt.min.js') }}"></script>
    <script src="{{ asset('front/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('front/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('front/js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('front/js/jquery.magnific-popup.js') }}"></script>
    <script src="{{ asset('front/js/select2.js') }}"></script>
    <script src="{{ asset('front/js/datepicker.js') }}"></script>
    <script src="{{ asset('front/js/YouTubePopUp.js') }}"></script>
    <script src="{{ asset('front/js/custom.js') }}"></script>
    <!-- Include CSS for Select2 -->
<!-- Include SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Optionally include the other SweetAlert (if you need both) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>



</body>
</html>
