<!-- resources/views/home.blade.php -->
@extends('front.layouts.master')

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@section('content')
    <!-- Preloader -->
    <div class="preloader-bg"></div>
    <div id="preloader">
        <div id="preloader-status">
            <div class="preloader-position loader"><span></span></div>
        </div>
    </div>

    <!-- Header Video -->
    <header class="header">
        <div class="video-fullscreen-wrap">
            <div class="video-fullscreen-video" data-overlay-dark="2">
                <video playsinline autoplay loop muted>
                    <source src="https://duruthemes.com/demo/html/renax/video.mp4" type="video/mp4">
                    <source src="https://duruthemes.com/demo/html/renax/video.webm" type="video/webm">
                </video>
            </div>
        </div>

        <!-- Clients -->
        <section class="clients">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="owl-carousel owl-theme">
                            @foreach(range(1, 8) as $index)
                                <div class="clients-logo">
                                    <a href="#0"><img src="{{ asset("front/img/clients/$index.png") }}" alt=""></a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </header>

    <section class="cars2 section-padding">
    <div class="container">
        <div class="row">
            <div class="col-4">
                <div class="section-title">
                    <h2>Our Cars</h2><br>
                    <p>Choose the car that fits your needs</p>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach($cars as $car)
                <div class="col-md-4 mb-30">
                    <div class="item" style="position: relative;">
                        <!-- Apply grayscale for "Arrive Soon" cars -->
                        <img src="{{ asset($car->car_picture) }}" class="img-fluid {{ $car->status == 'Arrive Soon' ? 'grayscale' : '' }}" alt="">
                        <div class="bottom-fade"></div>
                        <span style="position: absolute; top: 16px; left: 16px; background-color: green; color:white; padding: 5px; border-radius: 5px;">
                            <i class="omfi-status"></i>
                            {{ 
                                $car->status == 'Booked' ? 'Booked' : 
                                ($car->status == 'Arrive Soon' ? 'Arrive Soon' : 'Available') 
                            }}
                        </span>

                        <div class="title">
                            <h4>{{ $car->car_name . ' ' . $car->model }}</h4>
                            <div class="details">
                                <span><i class="omfi-door"></i> {{ $car->seats }} Seats</span>
                                <span><i class="omfi-transmission"></i> {{ $car->gear }}</span>
                                <span><i class="omfi-luggage"></i> {{ $car->bags }} Bags</span>
                            </div>
                            
                            <!-- Disable buttons if status is "Arrive Soon" -->
                            @if($car->status != 'Arrive Soon')
                                <div class="button-group mt-3">
                                    <button style="background-color: black; color: white; border: 2px solid white;" type="button" class="btn btn-primary reserve-button" data-bs-toggle="modal" data-bs-target="#bookingModal{{ $car->id }}">
                                        Reserve Now
                                    </button>
                                    <a style="background:#018834;border: 2px solid white;margin-left:2px;" href="https://wa.me/00971542700030?text={{ urlencode("Hello. I am interested in the: ".$car->car_name) }}" class="btn btn-success">WhatsApp</a>
                                </div>
                            @else
                                <!-- Placeholder to replace buttons for "Arrive Soon" cars -->
                                <div class="button-group mt-3">
                                    <button class="btn btn-secondary" disabled>Not Available</button>
                                </div>
                            @endif
                        </div>

                        <!-- Only show the price button if the car is available -->
                        @if($car->status != 'Arrive Soon')
                            <div class="curv-butn icon-bg">
                                <a href="{{ route('cars.show', $car->id) }}" class="vid">
                                    <div class="icon">
                                        <i class="icon-show"><span>AED {{ $car->price }}<br><i>day</i></span></i>
                                        <i class="ti-arrow-top-right icon-hidden"></i>
                                    </div>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>




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
