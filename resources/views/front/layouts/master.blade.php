<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="zxx">
<head>

<script async src="https://www.googletagmanager.com/gtag/js?id=AW-11504797989"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'AW-11504797989');
    </script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Luxuria Rental Car</title>
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap">
    <link rel="stylesheet" href="{{ asset('front/css/plugins.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" />
    <!-- Bootstrap JS and Popper.js (for modal functionality) -->


    
    
</head>

<style>
    .enlarged-image {
    max-width: 100%; /* تحديد أقصى عرض للصورة */
    max-height: 400px; /* تحديد أقصى ارتفاع للصورة */
    margin: 0 auto; /* توسيط الصورة */
    display: block;
}

</style>
<body>


    <!-- Promotion Modal -->
    <!-- @php
        $ad = \App\Models\Ad::first(); // Fetch the first ad from the database
    @endphp

    @if ($ad)
<div class="modal fade show" id="promotionModal" tabindex="-1" aria-labelledby="promotionModalLabel" aria-hidden="true" style="display: block;">
    <div class="modal-dialog modal-dialog-centered custom-modal-width">
        <div class="modal-content">
            <div class="modal-header bg-black">
                <h5 class="modal-title" id="promotionModalLabel">Hi There</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: white;"></button>
            </div>
            <div class="modal-body">
                <img src="{{ asset('storage/' . $ad->image) }}" alt="Promotion Image" class="img-fluid mt-3 enlarged-image">
            </div>
        </div>
    </div>
</div>
@endif -->



<nav class="navbar navbar-expand-lg">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div class="my-logo md-5 text-left">
                <a href="{{ route('index') }}">
                    <img src="{{ asset('front/img/new-logo3.png') }}" alt="" class="">
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
            <li class="nav-item"><a class="nav-link" href="{{ route('promotion.index') }}">Promotions</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>

            <div class="navbar-right">
            <div class="wrap d-flex align-items-center ms-2">
                <div class="icon me-2"><i class="flaticon-phone-call"></i></div>
                <div class="text">
                    <p class="mb-0">Need help?</p>
                    <h5 class="mb-0"><a href="tel:+971502711549">05 0271 1549</a></h5>
                </div>
            </div>
        </div>
        </ul>

      
    </div>

    
</nav>




@yield('content')



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
                                    <h6 style="font-family: 'Calisto MT', serif;">Call us</h6>
                                    <p style="font-family:'Calisto MT', serif;">+971502711549</p>
                                </div>
                            </div>
                            <div class="footer-contact-links-divider"></div>
                            <div class="footer-contact-link-wrapper">
                                <a href="{{ route('contact') }}" class="footer-contact-link d-flex align-items-center"> <!-- Use Bootstrap flex utility classes -->
                                    <div class="image-wrapper footer-contact-link-icon">
                                        <div class="icon-footer"> <i class="omfi-envelope"></i> </div>
                                    </div>
                                    <div class="footer-contact-link-content ms-2"> <!-- Add a margin-left to create some space between icon and text -->
                                        <h6 class="mb-0" style="font-family: 'Calisto MT', serif;">Write to us</h6> <!-- Optional: Remove margin-bottom on h6 for tighter alignment -->
                                        <p class="mb-0" style="font-family: 'Calisto MT', serif;">info@rentaluxuria.com</p> <!-- Optional: Remove margin-bottom on p for tighter alignment -->
                                    </div>
                                </a>
                            </div>

                            <div class="footer-contact-links-divider"></div>
                            <div class="footer-contact-link-wrapper">
                                <a href="https://www.google.com/maps/place/Luxuria+Cars+Rental/@25.3982346,55.4403971,64m/data=!3m1!1e3!4m6!3m5!1s0x3e5f596a8e876377:0x26f89404dd87b493!8m2!3d25.3982362!4d55.4404803!16s%2Fg%2F11wj48l2kp?entry=ttu&g_ep=EgoyMDI0MTAxNi4wIKXMDSoASAFQAw%3D%3D" target="_blank" class="footer-contact-link d-flex align-items-center">
                                    <div class="image-wrapper footer-contact-link-icon">
                                        <div class="icon-footer"> <i class="omfi-location"></i> </div>
                                    </div>
                                    <div class="footer-contact-link-content ms-2">
                                        <h6 class="mb-0" style="font-family: 'Calisto MT', serif;">Address</h6>
                                        <p class="mb-0" style="font-family: 'Calisto MT', serif;">Dubai Address - Shop No 9 - Dr Murad Building - Hor Al Anz East - Abu Hail - Dubai - UAE</p>
                                        <p class="mb-0" style="font-family: 'Calisto MT', serif;">Ajman Address - Al Rashidiya 3 - Ajman - United Arab Emirates</p>

                                    </div>
                                </a>
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
                    <div class="footer-logo ms-1">
                        <img src="{{ asset('front/img/new-logo3.png') }}" alt="">
                    </div>                        <div class="widget-text" style="font-family: 'Rajdhani', sans-serif;">
                            <p style="font-family: 'Calisto MT', serif;">The Right Car For Every Road - Rent Your Way
                            </p>
                            <div class="social-icons">
                                <ul class="list-inline">
                                    <li><a href="https://wa.me/971542700030"><i class="fa-brands fa-whatsapp"></i></a></li>
                                    <li><a href="https://www.facebook.com/profile.php?id=61566173455254&mibextid=JRoKGi"><i class="fa-brands fa-facebook-f"></i></a></li>
                                    <li><a href="https://www.instagram.com/luxuria_uae?igsh=MTYwNDNwcW9vNDV1Zw=="><i class="fa-brands fa-instagram"></i></a></li>
                                    <li><a href="https://www.tiktok.com/@rentluxuria_uae"><i class="fa-brands fa-tiktok"></i></a></li>
                                    <li><a href="https://x.com/Luxuria_rent"><i class="fa-brands fa-x"></i></a></li>


                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- quick links -->
                <div class="col-md-3 offset-md-1 widget-area">
                    <div class="widget clearfix usful-links">
                        <h3 class="widget-title" style="font-family: 'Calisto MT', serif;">Quick Links</h3>
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
                    <p class="mb-0">&copy;2024 <a href="#">Luxuria Cars</a>. All rights reserved.</p>
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


</body>
</html>
