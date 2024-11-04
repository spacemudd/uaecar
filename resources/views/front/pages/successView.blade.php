@extends('front.layouts.master')

@section('content')
<div class="preloader-bg"></div>
<div id="preloader">
    <div id="preloader-status">
        <div class="preloader-position loader"><span></span></div>
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
    </div>

    <style>
        .blue-icon {
            display: flex;
            align-items: center;
        }
        .icon-img {
            width: 18px; /* Adjust the size as needed */
            height: 18px; /* Maintain aspect ratio */
            margin-right: 10px; /* Space between icon and text */
        }
        @media (max-width: 600px) {
            .slogan {
                display: none;
            }
        }
        .carousel-item img {
            max-height: 700px; /* Adjust as needed */
            object-fit: cover; /* Maintain aspect ratio and fill the area */
        }
    </style>
</header>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="alert alert-success text-center mt-5 mb-5" role="alert">
                <h4 class="alert-heading">Your Request Has Been Successful!</h4>
                <p>Thank you for your submission. We will get back to you shortly.</p>
                <hr>
                <p class="mb-0">If you have any questions, feel free to contact us.</p>
            </div>
        </div>
    </div>
</div>

<footer class="footer">
    <!-- Your footer content here -->
</footer>

@endsection
