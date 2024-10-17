@extends('front.layouts.master')

@section('content')
    <div class="preloader-bg"></div>
    <div id="preloader">
        <div id="preloader-status">
            <div class="preloader-position loader"><span></span></div>
        </div>
    </div>

    <header class="header slider">
        <div class="owl-carousel owl-theme">
            <div class="text-center item bg-img" data-overlay-dark="4" data-background="{{ asset('front/img/slider/1.jpg') }}"></div>
        </div>
    </header>

    <section class="car-details section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="row mb-60">
                        <div class="col-md-12">
                            <div class="car-image mb-30">
                                <img src="{{ asset($car->car_picture) }}" class="img-fluid02" alt="{{ $car->car_name }}">
                            </div>

                            <h3>Image Gallery</h3>
                            <div class="row gallery-items mb-60">
                                @foreach($car->gallery as $image)
                                    <div class="col-4 gallery-masonry-wrapper single-item cardio">
                                        <a href="{{ asset($image->image_path) }}" title="" class="gallery-masonry-item-img-link img-zoom">
                                            <div class="gallery-box">
                                                <div class="gallery-img">
                                                    <img src="{{ asset($image->image_path) }}" class="img-fluid mx-auto d-block" alt="">
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>

                            <h3>General Information</h3>
                            <p class="mb-30">{{ $car->description }}</p>
                            <ul class="list-unstyled list">
                                <li>
                                    <div class="list-icon"><span class="ti-check"></span></div>
                                    <div class="list-text"><p><span>Daily Cost: </span>{{ $car->price_daily }}</p></div>
                                </li>
                                <li>
                                    <div class="list-icon"><span class="ti-check"></span></div>
                                    <div class="list-text"><p>Free Cancellation & Return</p></div>
                                </li>
                                <li>
                                    <div class="list-icon"><span class="ti-check"></span></div>
                                    <div class="list-text"><p>Rent Now Pay When You Arrive</p></div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    @if($car->gallery->isEmpty())
                        <p>No images available for this car.</p>
                    @endif

                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <ul class="accordion-box clearfix">
                                <!-- FAQs Here -->
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12">
                    <div class="sidebar-car">
                        <div class="title">
                            <h4>AED {{ $car->price_daily }} <span>/ Rent Per Day</span></h4>
                        </div>
                        <div class="item">
                            <h3>{{ $car->car_name . ' ' . $car->model }}</h3>

                            <!-- <div class="features"><span><i class="omfi-door"></i> Doors</span><p>{{ $car->doors }}</p></div> -->
                            <div class="features"><span><i class="omfi-passengers"></i> Passengers</span><p>{{ $car->seats }}</p></div>
                            <div class="features"><span><i class="omfi-transmission"></i> Transmission</span><p>{{ $car->gear }}</p></div>
                            <!-- <div class="features"><span><i class="omfi-condition"></i> Air Condition</span><p>{{ $car->air_condition == 1 ? 'Yes' : 'Not' }}</p></div> -->
                            <div class="features"><span><i class="omfi-age"></i> Year</span><p>{{ $car->year }}</p></div>
                            <div class="features"><span><i class="omfi-folder"></i> Color</span><p>{{ $car->color }}</p></div>

                            <div class="btn-double mt-30" data-grouptype="&amp;">
                                <a data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo" href="#0">Rent Now</a>
                                <a href="https://api.whatsapp.com/send?phone=8551004444" target="_blank"><span class="fa-brands fa-whatsapp"></span> WhatsApp</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Booking Form for {{ $car->car_name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="booking-box">
                        <div class="booking-inner clearfix">
                            <form method="post" action="{{ route('form.submit') }}" class="form1 contact__form clearfix">
                                @csrf
                                <input type="hidden" name="car_id" value="{{ $car->id }}">
                                
                                <div class="row">
                                    <div class="col-12">
                                        <div class="alert alert-success contact__msg" style="display: none" role="alert"> Your message was sent successfully. </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        <label>Car Name</label>
                                        <input name="carName" type="text" class="form-control" value="{{ $car->car_name }}" readonly>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <label>Car ID</label>
                                        <input type="text" class="form-control" value="{{ $car->id }}" name="carID" readonly>
                                    </div>
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
                                            <label>Pick Up Location</label>
                                            <div class="select1_inner">
                                                <select name="pickup_city" class="select2 select" style="width: 100%" required>
                                                    <option value="" disabled selected>Select a City</option>
                                                    <option value="Dubai">Dubai</option>
                                                    <option value="Abu Dhabi">Abu Dhabi</option>
                                                    <option value="Sharjah">Sharjah</option>
                                                    <option value="Alain">Alain</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="input1_wrapper">
                                            <label>Pick Up Date</label>
                                            <div class="input1_inner">
                                                <input name="pickup_date" type="text" class="form-control input datepicker" placeholder="Pick Up Date" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="input1_wrapper">
                                            <label>Return Date</label>
                                            <div class="input1_inner">
                                                <input name="return_date" type="text" class="form-control input datepicker" placeholder="Return Date" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 form-group">
                                        <textarea name="message" id="message" cols="30" rows="4" placeholder="Additional Note"></textarea>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <input type="hidden" name="daily_car_price" value="{{ $car->price_daily }}">
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
