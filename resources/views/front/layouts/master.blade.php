<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Luxuria Rental Car</title>
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap">
    <link rel="stylesheet" href="{{ asset('front/css/plugins.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}" />
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" />
</head>
<body>



<nav class="navbar navbar-expand-lg">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div class="my-logo md-5 text-left">
                <a href="{{ route('index') }}">
                    <img src="{{ asset('front/img/new-logo.png') }}" alt="" class="">
                </a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"><i class="fa-solid fa-bars"></i></span>
            </button>

        </div>

    </div>



    <div class="collapse navbar-collapse w-100" id="navbar">
        <ul class="navbar-nav me-auto w-100 d-flex justify-content-center ">
            <li class="nav-item"><a class="nav-link" href="{{ route('index') }}">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>

            <div class="navbar-right">
            <div class="wrap d-flex align-items-center ms-2">
                <div class="icon me-2"><i class="flaticon-phone-call"></i></div>
                <div class="text">
                    <p class="mb-0">Need help?</p>
                    <h5 class="mb-0"><a href="tel:+971542700030">05 4270 0030</a></h5>
                </div>
            </div>
        </div>
        </ul>

      
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
                                    <p>info@rentaluxuria.com</p>
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
                        <div class="footer-logo"><img src="{{ asset('front/img/new-logo.png') }}" alt=""></div>
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
                            <li><a href="{{ route('contact') }}">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <!-- subscribe -->
                <div class="col-md-4 widget-area">
                    <div class="widget clearfix">
                        <h3 class="widget-title">Subscribe</h3>
                        <p>Want to be notified about our services? Just sign up and we'll send you a notification by email.</p>
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
                    <p class="mb-0">&copy;2024 <a href="#">Luxuria Rental Car</a>. All rights reserved.</p>
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

<!-- Bootstrap JavaScript (with Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Other Scripts -->
<script src="{{ asset('front/js/modernizr-2.6.2.min.js') }}"></script>
<script src="{{ asset('front/js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('front/js/jquery.isotope.v3.0.2.js') }}"></script>
<script src="{{ asset('front/js/scrollIt.min.js') }}"></script>
<script src="{{ asset('front/js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('front/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('front/js/jquery.stellar.min.js') }}"></script>
<script src="{{ asset('front/js/jquery.magnific-popup.js') }}"></script>
<script src="{{ asset('front/js/select2.js') }}"></script>
<script src="{{ asset('front/js/datepicker.js') }}"></script>
<script src="{{ asset('front/js/YouTubePopUp.js') }}"></script>
<script src="{{ asset('front/js/custom.js') }}"></script>

<!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>
