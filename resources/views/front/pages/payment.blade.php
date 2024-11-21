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
        <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3">
            <a href="#" class="pay-card card p-3 shadow-sm h-100 d-flex flex-column">
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
            </a>
        </div>

        <!-- Tabby -->
        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3">
            <a href="#" class="pay-card card p-3 shadow-sm h-100 d-flex flex-column">
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
                    <span style="font-weight: bold;">{{ $total / 4 }}</span> AED
                </div>
            </a>
        </div>

        <!-- Tamara -->
        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3">
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
        </div>
    </div>
</div>
      <div class="container py-4">
    <div class="row g-3">
        <!-- Customer Information Section -->
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
                </div>
            </div>
        </div>

        <!-- Invoice Details Section -->
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
</div>
</div>
    </div>
    </div>
</div>

<!-- <div class="container mt-5 g-3">
  <h3 class="mx-auto mb-4">Similar Products</h3>
  <div id="similarProductsCarousel" class="">
    <div class="container">
      <div class="row">
        @foreach($similarProducts as $product)
          <div class="">
          <a href="{{ route('cars.show', $product->id) }}">

              <div class="card shadow-sm rounded" style="width: 200px;">
                <img src="{{ asset('storage/' . $product->car_picture) }}" class="card-img-top" alt="Product" style="width: 200px;">
                <div class="card-body">
                  <h5 class="card-title text-truncate">{{ $product->car_name . ' ' . $product->model . ' ' . $product->year }}</h5>
                  <p class="card-text text-muted" style="font-size: 20px;">{{ $product->price_daily }} AED</p>
                </div>
              </div>
            </a>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div> -->



<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="d-flex">
                <div class="carousel-item-inner">
                    <img src="https://via.placeholder.com/500x300?text=Item+1" class="d-block w-100" alt="Item 1">
                </div>
                <div class="carousel-item-inner">
                    <img src="https://via.placeholder.com/500x300?text=Item+2" class="d-block w-100" alt="Item 2">
                </div>
                <div class="carousel-item-inner">
                    <img src="https://via.placeholder.com/500x300?text=Item+3" class="d-block w-100" alt="Item 3">
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="d-flex">
                <div class="carousel-item-inner">
                    <img src="https://via.placeholder.com/500x300?text=Item+4" class="d-block w-100" alt="Item 4">
                </div>
                <div class="carousel-item-inner">
                    <img src="https://via.placeholder.com/500x300?text=Item+5" class="d-block w-100" alt="Item 5">
                </div>
                <div class="carousel-item-inner">
                    <img src="https://via.placeholder.com/500x300?text=Item+6" class="d-block w-100" alt="Item 6">
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="d-flex">
                <div class="carousel-item-inner">
                    <img src="https://via.placeholder.com/500x300?text=Item+7" class="d-block w-100" alt="Item 7">
                </div>
                <div class="carousel-item-inner">
                    <img src="https://via.placeholder.com/500x300?text=Item+8" class="d-block w-100" alt="Item 8">
                </div>
                <div class="carousel-item-inner">
                    <img src="https://via.placeholder.com/500x300?text=Item+9" class="d-block w-100" alt="Item 9">
                </div>
            </div>
        </div>
        <!-- Add more items as needed -->
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>




<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>






<div class="actions">
        <a href="#" class="backBtn">Go Back to Shop</a>
    </div>
  </section>
  </div>


