@extends('front.layouts.master')
@section('content')


<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-11504797989"></script>
<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'AW-11504797989');
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
  document.getElementById('showPopup').addEventListener('click', function() {
    
    // استخدم منطق الـ PHP لاختيار السعر بناءً على مدة الحجز
    let bookingDuration = "{{ session('booking_duration') }}";
    let rateWeekly = "{{ session('rate_weekly') }}";
    let rateMonthly = "{{ session('rate_monthly') }}";
    let rateDaily = "{{ session('rate_daily') }}";
    
    let rentAmount = 0;
    let totalAmount = 0;
    let installement = 0;
    // المنطق لاختيار السعر بناءً على مدة الحجز
    if (bookingDuration == 'Weekly') {
        rentAmount = Number(rateWeekly);  // تحويل القيمة إلى رقم
        totalAmount = (rentAmount + 1000) * 1.07;
        installementAmount = totalAmount / 4;

    } else if (bookingDuration == 'Monthly') {
        rentAmount = Number(rateMonthly);
        totalAmount = (rateMonthly + 1000) * 1.07;
        installementAmount = totalAmount / 4;

    } else if (bookingDuration == 'Daily') {
        let pickupDate = new Date("{{ session('pickup_date') }}");
        let returnDate = new Date("{{ session('return_date') }}");

        let timeDiff = returnDate - pickupDate;
        let daysDifference = timeDiff / (1000 * 3600 * 24); // تحويل الفرق بالميلي ثانية إلى أيام

        rentAmount = rateDaily * daysDifference;
        totalAmount = (rentAmount + 1000) * 1.07
        installementAmount = totalAmount / 4;

    }

    Swal.fire({
  title: `<div style="text-align: left; position: relative;"><br>
      <img src="{{ asset('front/img/tabbylogo.png') }}" alt="Logo" style="position: absolute; top: 10px; left: 10px; width: 150px; height: auto;">
        Divide it into 4 installments without interest.
      </div><br>`,
  
  html: `
    <div style="text-align: left; direction: ltr;">
      <p>The total amount is <strong>${totalAmount} AED </strong>, which is broken down as follows:</p>
      <ul>
        <li><strong>Rent:</strong> ${rentAmount} AED</li>
        <li><strong>Refundable Deposit:</strong> 1000 AED</li>
        <li><strong>Tabby Service Fee (7%):</strong> 154 AED</li>
      </ul>
      <br>
      <div style="display: flex; align-items: center; justify-content: flex-start; margin-top: 10px;">
        <!-- Icon first, then text -->
        <div style="display: block; height: 20px; width: 20px; border-radius: 100%; border: 1px solid #54545C; overflow: hidden; position: relative; background: #fff;">
          <div style="position: absolute; top: 0; left: 0; width: 50%; height: 58%; background: #54545C;"></div>
        </div>
        <span style="font-size: 14px; margin-left: 10px;">Today ${installementAmount.toFixed(2)} AED</span>
      </div>
      <br>
      <div style="display: flex; align-items: center; justify-content: flex-start; margin-top: 10px;">
        <div style="display: block; height: 20px; width: 20px; border-radius: 100%; border: 1px solid #54545C; overflow: hidden; position: relative; background: #fff;">
          <div style="position: absolute; top: 0; left: 0; width: 50%; height: 100%; background: #54545C;"></div>
        </div>
        <span style="font-size: 14px; margin-left: 10px;">After 1 month ${installementAmount.toFixed(2)} AED</span>
      </div>
      <br>
      <div style="display: flex; align-items: center; justify-content: flex-start; margin-top: 10px;">
        <div style="display: block; height: 20px; width: 20px; border-radius: 100%; border: 1px solid #54545C; overflow: hidden; position: relative; background: conic-gradient(#54545C 0deg 270deg, #fff 270deg 360deg);">
        </div>
        <span style="font-size: 14px; margin-left: 10px;">After 2 months ${installementAmount.toFixed(2)} AED</span>
      </div>
      <br>
      <div style="display: flex; align-items: center; justify-content: flex-start; margin-top: 10px;">
        <div style="display: block; height: 20px; width: 20px; border-radius: 100%; border: 1px solid #54545C; overflow: hidden; position: relative; background: #fff;">
          <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: #54545C;"></div>
        </div>
        <span style="font-size: 14px; margin-left: 10px;">After 3 months ${installementAmount.toFixed(2)} AED</span>
      </div>
    </div>`,
  
  showCloseButton: true,
  showCancelButton: true,
  confirmButtonText: 'Close',
  cancelButtonText: 'Pay Now',
  width: '700px',  // Increase the width of the message
  cancelButtonColor: 'rgb(30, 204, 124)',
  confirmButtonColor: '#8a8aff',
  didOpen: () => {
    const payNowButton = Swal.getCancelButton();
    payNowButton.addEventListener('click', () => {
      // مباشرة إرسال البيانات بدون تأكيد
      const form = document.createElement('form');
      form.method = 'POST';
      form.action = "{{ route('create.checkout') }}"; // رابط الـ route

      const csrfToken = document.createElement('input');
      csrfToken.type = 'hidden';
      csrfToken.name = '_token';
      csrfToken.value = "{{ csrf_token() }}"; // توكن الـ CSRF من Laravel
      form.appendChild(csrfToken);

      // إرسال الفورم
      document.body.appendChild(form);
      form.submit();
    });
  }
});

  });
});
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

<div class="alert alert-danger" style="margin-top: 10px;">
            Note: There will be an additional fee of 1000 AED + 7% if the Tabby or Tamara service is selected.
        </div>

           


<!-- <div class="container">
    <div class="row g-3">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
    <form action="{{ route('stripe.payment') }}" method="POST" class="pay-card card p-3 shadow-sm h-100 d-flex flex-column">
        @csrf 

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

    <input type="hidden" name="car_id" value="{{ $car->id }}">
    <input type="hidden" name="price_daily" value="{{ $price_daily }}">
    <input type="hidden" name="days" value="{{ $days }}">
    <input type="hidden" name="total" value="{{ $total }}">
    <input type="hidden" name="pickup_date" value="{{ $pickup_date }}">
    <input type="hidden" name="return_date" value="{{ $return_date }}">
    
    <input type="hidden" name="customer_name" value="{{ $customer_name }}">
    <input type="hidden" name="customer_email" value="{{ $customer_email }}">
    <input type="hidden" name="customer_phone" value="{{ $customer_mobile }}">
    <input type="hidden" name="customer_city" value="{{ $pickup_city }}">
        <button type="submit" class="btn btn-primary mt-3">Pay Now</button>
    </form>
</div> -->
<div class="container text-center mt-1">
    <div class="d-flex flex-column align-items-start mt-4">

        <!-- صندوق لاحتواء خيارات الدفع -->
        <div class="payment-options border rounded p-3 mb-2">
            <label class="radio-btn d-flex align-items-center">
                <input type="radio" name="selective" value="Point 1" style="margin-right: 10px;">
                <div class="border rounded p-2" style="width: 100%;">
                    <div class="d-flex align-items-center">
                        <span class="me-2">Credit/Debit Card</span>
                    </div>
                    <div class="text-start" style="margin-top: 5px;">
                        <img src="{{ asset('front/img/icons/visa.png') }}" alt="Visa" style="width: 30px; height: 20px; margin-right: 5px;">
                        <img src="{{ asset('front/img/icons/MasterCard_Logo.svg.png') }}" alt="Mastercard" style="width: 30px; height: 20px; margin-right: 5px;">
                        <img src="{{ asset('front/img/icons/شعار-مدى.png') }}" alt="Mastercard" style="width: 30px; height: 20px; margin-right: 5px;">
                        <span>You can pay with debit or credit.</span>
                    </div>
                </div>
            </label>

            <label class="radio-btn d-flex align-items-center mt-3 text-start">
                <input type="radio" name="selective" value="Point 2" style="margin-right: 10px;">
                <div class="border rounded p-2" style="width: 100%;">
                    <img src="{{ asset('front/img/icons/tabby.png') }}" alt="Tabby" style="width: 70px; height: 30px; margin-right: 10px;">
                    <span>Pay in 4. No interest, no fees.</span>
                </div>
            </label>
            <div id="TabbyPromo" class="mt-3"></div>
        </div>

        <!-- نموذج Checkout -->
        <form id="checkoutForm" action="{{ route('stripe.payment') }}" method="POST">
            @csrf <!-- إضافة توكن CSRF لحماية النموذج -->
            
            <!-- Hidden inputs for passing data -->
            <input type="hidden" name="car_id" value="{{ $car->id }}">
            <input type="hidden" name="price_daily" value="{{ $price_daily }}">
            <input type="hidden" name="days" value="{{ $days }}">
            <input type="hidden" name="total" value="{{ $total }}">
            <input type="hidden" name="pickup_date" value="{{ $pickup_date }}">
            <input type="hidden" name="return_date" value="{{ $return_date }}">
            <input type="hidden" name="customer_name" value="{{ $customer_name }}">
            <input type="hidden" name="customer_email" value="{{ $customer_email }}">
            <input type="hidden" name="customer_phone" value="{{ $customer_mobile }}">
            <input type="hidden" name="customer_city" value="{{ $pickup_city }}">

            <button type="submit" class="btn btn-primary mt-3">Checkout</button>
        </form>
    </div>
</div>

<style>
    .payment-options {
        border: 1px solid #ccc; /* حدود خفيفة */
        border-radius: 5px; /* زوايا مستديرة */
        padding: 15px; /* حشوة داخل الصندوق */
    }
    .payment-options:hover {
        border-color: #007bff; /* تغيير لون الحدود عند التحويم */
    }
    .radio-btn > div {
        border: 1px solid #ccc; /* حدود خفيفة للصندوق الداخلي */
        border-radius: 5px; /* زوايا مستديرة للصندوق الداخلي */
        padding: 10px; /* حشوة داخل الصندوق */
        width: 100%; /* عرض كامل للصندوق الداخلي */
    }
</style>

<script>
    // تحديد جميع الراديوهات
    const radioButtons = document.querySelectorAll('.radio-btn');

    // إضافة حدث للزر Checkout
    document.getElementById('checkoutForm').addEventListener('submit', (event) => {
        const selectedValue = document.querySelector('input[name="selective"]:checked');
        if (!selectedValue) {
            event.preventDefault(); // منع تقديم النموذج إذا لم يتم اختيار طريقة الدفع
            alert('يرجى اختيار طريقة الدفع أولاً.');
        } else {
            // التحقق مما إذا كانت طريقة الدفع هي "Tabby"
            if (selectedValue.value === "Point 2") { // تأكد من استخدام القيمة الصحيحة
                event.preventDefault(); // منع تقديم النموذج بشكل افتراضي
                const form = event.target;
                form.action = "{{ route('create.checkout') }}"; // تغيير الإجراء إلى الروت المطلوب
                form.method = "POST"; // تأكد من أن الطريقة هي POST
                form.submit(); // تقديم النموذج بعد تغيير الإجراء
            }
            // إذا كانت طريقة الدفع مختلفة، فسيتم تقديم النموذج إلى الإجراء الافتراضي
        }
    });
</script>




<script src="https://checkout.tabby.ai/tabby-promo.js"></script>
<script>

let bookingDuration = "{{ session('booking_duration') }}";
    let rateWeekly = "{{ session('rate_weekly') }}";
    let rateMonthly = "{{ session('rate_monthly') }}";
    let rateDaily = "{{ session('rate_daily') }}";
    
    let rentAmount = 0;
    let totalAmount = 0;
    let installement = 0;
    // المنطق لاختيار السعر بناءً على مدة الحجز
    if (bookingDuration == 'Weekly') {
        rentAmount = Number(rateWeekly);  // تحويل القيمة إلى رقم
        totalAmount = (rentAmount + 1000) * 1.07;
        new TabbyPromo({
        selector: '#TabbyPromo', // يجب أن يتطابق مع المعرف أعلاه
        currency: 'AED', // العملة المطلوبة (AED|SAR|KWD)
        price: totalAmount, // سعر المنتج
        lang: 'en', // اللغة (en|ar)
        source: 'product', // المصدر (product أو cart)
        publicKey: 'YOUR_PUBLIC_API_KEY', // مفتاحك العام
        merchantCode: 'YOUR_MERCHANT_CODE' // كود المتجر الخاص بك
      });

    } else if (bookingDuration == 'Monthly') {
        rentAmount = Number(rateMonthly);
        totalAmount = (rateMonthly + 1000) * 1.07;
        new TabbyPromo({
        selector: '#TabbyPromo', // يجب أن يتطابق مع المعرف أعلاه
        currency: 'AED', // العملة المطلوبة (AED|SAR|KWD)
        price: totalAmount, // سعر المنتج
        lang: 'en', // اللغة (en|ar)
        source: 'product', // المصدر (product أو cart)
        publicKey: 'YOUR_PUBLIC_API_KEY', // مفتاحك العام
        merchantCode: 'YOUR_MERCHANT_CODE' // كود المتجر الخاص بك
      });

    } else if (bookingDuration == 'Daily') {
        let pickupDate = new Date("{{ session('pickup_date') }}");
        let returnDate = new Date("{{ session('return_date') }}");

        let timeDiff = returnDate - pickupDate;
        let daysDifference = timeDiff / (1000 * 3600 * 24); // تحويل الفرق بالميلي ثانية إلى أيام

        rentAmount = rateDaily * daysDifference;
        totalAmount = (rentAmount + 1000) * 1.07
        new TabbyPromo({
        selector: '#TabbyPromo', // يجب أن يتطابق مع المعرف أعلاه
        currency: 'AED', // العملة المطلوبة (AED|SAR|KWD)
        price: totalAmount, // سعر المنتج
        lang: 'en', // اللغة (en|ar)
        source: 'product', // المصدر (product أو cart)
        publicKey: 'YOUR_PUBLIC_API_KEY', // مفتاحك العام
        merchantCode: 'YOUR_MERCHANT_CODE' // كود المتجر الخاص بك
      });

    }


</script>



        <!-- Tabby -->
        <!-- <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3">
    <div id="showPopup" class="pay-card card p-3 shadow-sm h-100 d-flex flex-column">
        <div class="d-flex align-items-left mb-3">
            <div class="image">
                <img src="{{ asset('front/img/icons/tabby01.png') }}" alt="Image" class="img-fluid rounded-3" style="width: 100px; height: 50px; object-fit: cover;">
            </div>
            <div class="text ms-3">
                <span class="fw-bold" style="font-size: 20px;">Tabby</span>
                <p style="font-size: 12px; font-weight: lighter; color: #6c757d;">Split your payments into 4 interest-free installments</p>
            </div>
        </div>
    </div>
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


<!-- <section>
  <div id="carouselExampleCaptions" class="carousel slide">
    <div class="carousel-inner"> 
      <div class="carousel-item active">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-1 justify-content-center">
          @foreach($similarProducts as $car)
          <div class="col d-flex justify-content-center">
            <div class="card shadow-sm mx-8 my-5">
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
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section> -->

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

@endsection