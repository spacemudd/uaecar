<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-11504797989"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'AW-11504797989');
</script>


<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link rel="shortcut icon" href="{{ asset('favicon.png') }}" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap">
<link rel="stylesheet" href="{{ asset('front/css/plugins.css') }}" />
<link rel="stylesheet" href="{{ asset('front/css/pstyle.css') }}" />




<div class="mx-auto text-center" style="max-width: 500px;">
        <img class="col-xxl-12 mx-auto" src="{{ asset('front/img/black.png') }}">
        </div>

  <section class="content">

    <div class="image-logo" style="max-width: 500px; min-height: 200px; margin-left: auto; margin-right: auto; border-radius: 8px; display: flex; flex-direction: column; position: relatie;">
    <img class="col-sm-lg-xs-6 col-xxl-12" src="{{ asset('storage/' . $car->car_picture) }}">

    </div>


    <div class="container">
      <div class="payment">
      <div class="payment__shipping">
    <div class="payment__title-car fs-1">
        <i class="icon icon-car"></i> {{ $car->car_name . ' ' . $car->model . ' ' . $car->year }}
    </div>
    <div class="details__user">
        <div class="user__name">
            <ul class="list-unstyled" style="padding-left: 20px; width:1000px">
                <li class="row">
                    <div class="col-md-3" style="white-space: nowrap; padding-right: 100px;">
                        <i class="fas fa-check-circle text-success" style="font-size: 16px; vertical-align: middle;"></i> Free Shipping
                    </div>
                    <div class="col-md-3" style="white-space: nowrap; padding-right: 100px;">
                        <i class="fas fa-check-circle text-success" style="font-size: 16px; vertical-align: middle;"></i> {{ $car->seats }} Seats
                    </div>
                    <div class="col-md-3" style="white-space: nowrap; padding-right: 100px;">
                        <i class="fas fa-check-circle text-success" style="font-size: 16px; vertical-align: middle;"></i> {{ $car->doors }} Doors
                    </div>
                    <div class="col-md-3" style="white-space: nowrap;">
                        <i class="fas fa-check-circle text-success" style="font-size: 16px; vertical-align: middle;"></i> Color {{$car->color}}
                    </div>
                </li>
                <li class="row">
                    <div class="col-md-3" style="white-space: nowrap; padding-right: 100px;">
                        <i class="fas fa-check-circle text-success" style="font-size: 16px; vertical-align: middle;"></i> Rate daily <strong>{{ $car->price_daily }}</strong> AED
                    </div>
                    <div class="col-md-3" style="white-space: nowrap; padding-right: 100px;">
                        <i class="fas fa-check-circle text-success" style="font-size: 16px; vertical-align: middle;"></i> Rate Weekly <strong>{{ $car->price_weekly }}</strong> AED
                    </div>
                    <div class="col-md-3" style="white-space: nowrap; padding-right: 0px;">
                        <i class="fas fa-check-circle text-success" style="font-size: 16px; vertical-align: middle;"></i> Rate Monthly <strong>{{ $car->price_monthly }}</strong> AED
                    </div>
                    <div class="col-md-3" style="white-space: nowrap;">
                        <i class="fas fa-check-circle text-success" style="font-size: 16px; vertical-align: middle;"></i> {{$car->categories}}
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

            <div class="payment__title">
            Payment Method
            </div>


            <div class="container">
    <div class="row g-3">
        <!-- Credit/Debit Card -->
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
    <form action="{{ route('stripe.payment') }}" method="POST" class="pay-card card p-3 shadow-sm h-100 d-flex flex-column">
        @csrf <!-- Include this for Laravel CSRF protection -->

        <div class="d-flex align-items-center mb-3">
            <div class="image">
                <img src="{{ asset('front/img/icons/visa.png') }}" alt="Image" class="img-fluid rounded-3" style="width: 30px; height: 30px; object-fit: cover;">
            </div>
            <div class="text ms-3 flex-grow-1">
                <span class="fw-bold">Credit/Debit Card</span>
            </div>
        </div>
        <div class="paragraph mt-auto">
            Pay with Visa or Mastercard, debit, or credit.
        </div>

          <!-- Hidden inputs to pass required data -->
    <input type="hidden" name="car_id" value="{{ $car->id }}">
    <input type="hidden" name="price_daily" value="{{ $price_daily }}">
    <input type="hidden" name="days" value="{{ $days }}">
    <input type="hidden" name="total" value="{{ $total }}">
    <input type="hidden" name="pickup_date" value="{{ $pickup_date }}">
    <input type="hidden" name="return_date" value="{{ $return_date }}">
    
    <!-- Add hidden inputs for customer information -->
    <input type="hidden" name="customer_name" value="{{ $customer_name }}">
    <input type="hidden" name="customer_email" value="{{ $customer_email }}">
    <input type="hidden" name="customer_phone" value="{{ $customer_mobile }}">
    <input type="hidden" name="customer_city" value="{{ $pickup_city }}">
        <button type="submit" class="btn btn-primary mt-3">Pay Now</button>
    </form>
</div>




        <!-- Tabby -->
        <!-- <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3">
            <form action="{{ route('create.checkout') }}" method="POST" class="pay-card card p-3 shadow-sm h-100 d-flex flex-column">
                @csrf
                <input type="hidden" name="amount" value="{{ $total }}"> 
                <input type="hidden" name="currency" value="AED">

                <div class="d-flex align-items-center mb-3">
                    <div class="image">
                        <img src="{{ asset('front/img/icons/tabby01.png') }}" alt="Image" class="img-fluid rounded-3" style="width: 30px; height: 30px; object-fit: cover;">
                    </div>
                    <div class="text ms-3 flex-grow-1">
                        <span class="fw-bold">Tabby</span>
                    </div>
                </div>
                <div class="paragraph mt-auto">
                    Pay in 4 interest-free payments of <br>
                    <span style="font-weight: bold;" id="tabby-payment-amount"></span> AED
                </div>

                <div id="tabby-promo-widget"></div>

                <button type="submit" class="btn btn-primary mt-2">Pay Now</button>
            </form>
        </div> -->


        <!-- Tamara -->
        <!-- <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3">
            <a href="#" class="pay-card card p-3 shadow-sm h-100 d-flex flex-column">
                <div class="d-flex align-items-center mb-3">
                    <div class="image">
                        <img src="{{ asset('front/img/icons/tamara.png') }}" alt="Image" class="img-fluid rounded-3" style="width: 30px; height: 30px; object-fit: cover;">
                    </div>
                    <div class="text ms-3 flex-grow-1">
                        <span class="fw-bold">Tamara</span>
                    </div>
                </div>
                <div class="paragraph mt-auto">
                    Pay in 4 interest-free payments of <br>
                    <span style="font-weight: bold;">{{ $total / 4 }}</span> AED
                </div>
            </a>
        </div> -->





    </div>
</div>
      <!-- <div class="container py-4">
    <div class="row g-3">
        <div class="col-12 col-sm-12 col-md-6 fs-6">
            <div class="bg-light p-3 p-md-4 rounded shadow-sm h-100">
                <h5 class="mb-3">
                    <i class="bi bi-person-circle me-2"></i>Customer Information
                </h5>
                <div class="mb-1">
                    <strong>Name:</strong> {{ $customer_name }}
                </div>
                <div class="mb-1">
                    <strong>Pickup Date:</strong> {{ $pickup_date }}
                </div>
                <div class="mb-1">
                    <strong>Return Date:</strong> {{ $return_date }}
                </div>
                <div class="mt-1">
                    <strong>Phone Number:</strong> {{ $customer_mobile }}
                    <br>
                    <strong>Email Address:</strong> {{ $customer_email }}
                    <br>
                    <strong>Pickup City:</strong> {{ $pickup_city }}
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-12 col-md-6 fs-6">
            <div class="bg-light p-3 p-md-4 rounded shadow-sm h-100">
                <h5 class="mb-3">
                    <i class="bi bi-receipt me-2"></i>Invoice Details
                </h5>
                <div class="mb-1">
                    <strong>Car Daily Cost:</strong> {{ $car->price_daily }} AED
                </div>
                <div class="mb-1">
                    <strong>Tax:</strong> 50 AED
                </div>
                <div class="mb-1">
                    <strong>Shipping Fee:</strong> 0 AED
                </div>
                <div class="mt-1">
                    <strong>Total:</strong>
                    <span style="font-weight: bold; font-size: 18px;">{{ $total }} AED</span>
                </div>
            </div>
        </div>
    </div>
</div> -->
</div>
    </div>
    </div>
</div>


<section>
  <div id="carouselExampleCaptions" class="carousel slide">
    <div class="carousel-inner"> <!-- The Carousel Container -->
      <!-- Carousel Item 1 -->
      <div class="carousel-item active">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-1 justify-content-center">
          @foreach($similarProducts as $car)
          <div class="col d-flex justify-content-center">
            <div class="card shadow-sm mx-8 my-5">
              <!-- Image Section -->
              <img src="{{ asset('storage/' . $car->car_picture) }}" 
                   class="card-img-top" 
                   alt="Car Image" 
                   style="height: 300px; object-fit: cover;" />
              <div class="card-body">
                <i class="fa-solid fa-star text-warning"></i>
                <i class="fa-solid fa-star text-warning"></i>
                <i class="fa-solid fa-star text-warning"></i>
                <i class="fa-regular fa-star text-warning"></i>
                <i class="fa-regular fa-star text-warning"></i>
                <p class="card-text">{{ $car->make }} - {{ $car->model }} - {{$car->year}}</p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                  <a href="{{ route('cars.show', $car->id) }}" class="btn btn-sm btn-outline-warning">View</a>                  </div>
                  <small class="text-bg-warning px-2 rounded">{{ $car->price_daily }} AED</small>
                </div>
              </div>
            </div><!-- End of card -->
          </div>
          @endforeach
        </div><!-- End of row -->
      </div><!-- End of carousel-item -->
    </div><!-- End of carousel-inner -->
  </div>
</section>

</div>

</section>






<div class="actions">
        <!-- <a href="#" class="backBtn">Choose different payment method</a> -->
    </div>
  </section>
  </div>



  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

