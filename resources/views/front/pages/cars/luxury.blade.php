@extends('front.layouts.master')


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/owl.carousel.min.js"></script>
<script async src="//www.instagram.com/embed.js"></script>




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

    <!-- Clients Section -->
    <section class="clients mt-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="owl-carousel owl-theme">
                        @foreach(range(1, 11) as $i)
                            <div class="clients-logo">
                                <a href="#0"><img src="{{ asset('front/img/clients/' . $i . '.png') }}" alt=""></a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>



  <!-- Luxury Cars Section -->
    <section class="cars2 section-padding my-0 py-0 px-3 mx-auto py-5 mt-5">
    
    <div class="row">
    <div class="col-12 text-left"> <!-- Changed from text-center to text-left -->
        <h2 class="display-4 mb-4" style="font-family: 'Calisto MT', serif;">Luxury Cars</h2>
        <p style="font-family: 'Calisto MT', serif; color:#0F2026;">Choose from our finest luxury cars</p>
    </div>
</div>


        <div class="row gy-2">
            <!-- Loop through luxury cars only -->
            @foreach($cars as $car)
                @if(strtolower($car->categories) === 'luxury')  <!-- Filter only luxury cars -->
                    <!-- Car Card -->
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-3 " style="text-decoration: none;">
                    <div class="card3 w-100">
                    <span class="px-4 py-3" style="display: inline-block;">
                        <h3 class="car_name" style="display: inline-block; margin: 0; font-size: 23px; font-family: 'Calisto MT', serif;">{{ $car->car_name . ' ' . $car->model}}</h3>
                        <br>
                        <h4 class="car_name" style="display:inline-block; margin:0; font-family: 'Calisto MT', serif;">{{ $car->year }}</h4>
                    </span>
                    <div class="span-group px-3 fw-bold" style="font-size: 12px; font-family: 'Calisto MT', serif;">
                        <span>{{ $car->seats . ' Seats' }}</span>
                        <span>{{ $car->doors . ' Doors' }}</span>
                        <span>Automatic</span>
                        <span style="background-color: #003366; color: white;">Luxury</span>
                        </div>
                    <a href="{{ route('cars.show', $car->id) }}">

                    <div>
                        <img src="{{ asset('storage/' . $car->car_picture) }}" alt="Car Picture">
                    </div>
                    </a>
                    <div class="row mb-5 gx-2 justify-content-center">
                        <div class="col-4">
                            <h4 class="text-center text-white" style="font-family: 'Calisto MT', serif; font-size:medium;">Daily</h4>
                            <h6 class="text-center text-white fw-bold" style="font-family: 'Calisto MT', serif; font-size:large;">{{ $car->price_daily }} <span>AED</span></h6>
                        </div>

                        <div class="col-4">
                            <h4 class="text-center text-white" style="font-family: 'Calisto MT', serif; font-size:medium;">Weekly</h4>
                            <h6 class="text-center text-white fw-bold" style="font-family: 'Calisto MT', serif; font-size:large;">{{ $car->price_weekly }} <span>AED</span></h6>
                        </div>

                        <div class="col-4">
                            <h4 class="text-center text-white" style="font-family: 'Calisto MT', serif; font-size:medium;">Monthly</h4>
                            <h6 class="text-center text-white fw-bold" style="font-family: 'Calisto MT', serif; font-size:large;">{{ $car->price_monthly }} <span>AED</span></h6>
                        </div>
                        <div class="row">
                        <div class="col-6">
                            <div class="mb-3 d-flex justify-content-start">
                                <button class="btn text-center my-2" style="background-color: #949494; color: white; font-family: 'Calisto MT', serif;" data-bs-toggle="modal" data-bs-target="#bookingModal{{ $car->id }}">
                                    Book Now
                                </button>
                            </div>
                        </div>

                            
                            <div class="col-6 position-relative">
                                <div class="mb-3">
                                    <!-- WhatsApp Icon as a clickable link -->
                                    <a href="https://wa.me/971542700030?text=Hi!%20I%20am%20interested%20in%20this%20car.%20Here%20is%20the%20link%20to%20the%20car:%20{{ route('cars.show', ['id' => $car->id]) }}%20and%20here%20is%20the%20image%20of%20the%20car:%20{{ asset('path/to/car-image.jpg') }}" target="_blank" class="position-absolute bottom-0 end-0 mb-4 me-3">
                                        <i class="fab fa-whatsapp" style="font-size: 40px; color: #25D366;"></i> <!-- Larger WhatsApp icon -->
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                    </div>
               
                    </div>
                @endif
            @endforeach
        </div>
    
    </section>



    <!-- Cars Section -->
   









@endsection