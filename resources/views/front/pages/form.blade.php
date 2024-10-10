<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="LUXURI BOOK FORM">
    <meta name="author" content="Your Name">
    <meta name="keywords" content="Car Booking Form">
    
    <title>LUXURIA BOOK FORM</title>
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" />
    <link href="{{ asset('front/form/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet">
    <link href="{{ asset('front/form/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">
    <link href="{{ asset('front/form/vendor/select2/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('front/form/vendor/datepicker/daterangepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('front/form/css/main.css') }}" rel="stylesheet">
</head>

<body>
    <div class="page-wrapper bg-blue p-t-100 p-b-100 font-robo">
        <div class="wrapper wrapper--w680">
            <div class="card card-1">
                <div class="card-body">
                    <h2 class="title">Elevate your journey—Book your dream car with LUXURIA today!</h2>

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                            <span class="close" onclick="this.parentElement.style.display='none';">&times;</span>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                            <span class="close" onclick="this.parentElement.style.display='none';">&times;</span>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('form.submit') }}">
                        @csrf
                        <div class="input-group">
                            <label class="input--style-1">{{ $car->car_name }}</label>
                        </div>
                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="Full Name" name="full_name" required>
                        </div>
                        <div class="input-group">
                            <input class="input--style-1" type="email" placeholder="Email Address" name="email" required>
                        </div>
                        <div class="input-group">
                            <input class="input--style-1" type="tel" placeholder="Phone Number" name="phone" required pattern="[0-9]*">
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-1 js-datepicker" type="text" placeholder="Date From" name="date_from" required>
                                    <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-1 js-datepicker" type="text" placeholder="Date To" name="date_to" required>
                                    <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
                                </div>
                            </div>
                        </div>
                        <div class="input-group">
                            <div class="rs-select2 js-select-simple select--no-search">
                                <select name="pickup_city" required>
                                    <option disabled="disabled" selected="selected">Pickup City</option>
                                    <option value="Dubai">Dubai</option>
                                    <option value="Abu Dhabi">Abu Dhabi</option>
                                    <option value="Sharjah">Sharjah</option>
                                    <option value="Ajman">Ajman</option>
                                    <option value="Ras Al Khaimah">Ras Al Khaimah</option>
                                    <option value="Fujairah">Fujairah</option>
                                    <option value="Umm Al-Quwain">Umm Al-Quwain</option>
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                        </div>
                        <div class="p-t-20">
                            <button class="btn btn--radius btn--green" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('front/form/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('front/form/vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('front/form/vendor/datepicker/moment.min.js') }}"></script>
    <script src="{{ asset('front/form/vendor/datepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('front/form/js/global.js') }}"></script>
</body>

</html>
