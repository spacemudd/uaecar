<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- CSS مكتبة Flatpickr -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<!-- JavaScript مكتبة Flatpickr -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY&libraries=places"></script>


<script>
  $(document).ready(function() {
    // تهيئة Flatpickr لحقل تاريخ الاستلام
    flatpickr("#pickup_date", {
      enableTime: true, // تفعيل الوقت
      dateFormat: "Y-m-d H:i", // تنسيق التاريخ والوقت
      onChange: function(selectedDates, dateStr, instance) {
        if (selectedDates.length > 0) {
          $('#pickup_date').val(dateStr); // التأكد من إدخال التاريخ الصحيح
        }
      }
    });

    // تهيئة Flatpickr لحقل تاريخ العودة
    flatpickr("#return_date", {
      enableTime: true, // تفعيل الوقت
      dateFormat: "Y-m-d H:i", // تنسيق التاريخ والوقت
      onChange: function(selectedDates, dateStr, instance) {
        if (selectedDates.length > 0) {
          $('#return_date').val(dateStr); // التأكد من إدخال التاريخ الصحيح
        }
      }
    });
  });

  // دالة التحقق من صحة النموذج
  function validateForm(event) {
    const pickupDate = document.getElementById('pickup_date').value;
    const returnDate = document.getElementById('return_date').value;

    // التأكد من أن كلا التاريخين قد تم تعبئتهما
    if (!pickupDate || !returnDate) {
      alert('Please fill out both pickup and return dates.');
      event.preventDefault();
      return false;
    }

    // التأكد من أن تاريخ العودة بعد تاريخ الاستلام
    if (new Date(returnDate) <= new Date(pickupDate)) {
      alert('Return date must be after pickup date.');
      event.preventDefault();
      return false;
    }
    
    return true;
  }
</script>

<div class="modal fade" id="bookingModal{{ $car->id }}" tabindex="-1" aria-labelledby="bookingModalLabel{{ $car->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookingModalLabel{{ $car->id }}">Booking Form for {{ $car->car_name . $car->model }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="booking-box">
                    <div class="booking-inner clearfix">
                        <form method="post" action="{{ route('form.submit') }}" class="form1 contact__form clearfix" id="bookingForm{{ $car->id }}" onsubmit="return validateForm(event)">
                            @csrf
                            <input type="hidden" name="car_id" value="{{ $car->id }}">
                            <input type="hidden" name="plate_number" value="{{ $car->plate_number }}">
                            <input type="hidden" name="price_daily" value="{{ $car->price_daily}}">
                            <input type="hidden" name="price_weekly" value="{{ $car->price_weekly}}">
                            <input type="hidden" name="price_monthly" value="{{ $car->price_monthly}}">
                            <input type="hidden" name="car_name" value="{{ $car->car_name . ' ' . $car->model}}">
                            <input type="hidden" name="car_category" value="{{ $car->categories }}">
                            <img src="{{ asset('storage/' . $car->car_picture) }}" alt="Car Picture" />
                            <input type="hidden" name="car_picture" value="{{ asset('storage/' . $car->car_picture) }}">

                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <input name="name" type="text" placeholder="Full Name *" required>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <input name="email" type="email" placeholder="Email *" required>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <input name="phone" type="text" placeholder="971xxxxxxxxx" required>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="select1_wrapper">
                                        <label>Pick Up Location</label>
                                        <div class="select1_inner">
                                            <select name="pickup_city" class="select2 select" style="width: 100%" required>
                                                <option value="" disabled selected>Select a City</option>
                                                <option value="Dubai">Dubai</option>
                                                <option value="Sharjah">Sharjah</option>
                                                <option value="Alain">Ajman</option>
                                                <option value="Alain">Alain</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="select1_wrapper">
                                        <label>Booking Duration</label>
                                        <div class="select1_inner">
                                            <select id="bookingDuration{{ $car->id }}" name="booking_duration" class="select2 select" style="width: 100%" required>
                                                <option value="" disabled selected>Select Duration</option>
                                                <option value="Daily">Daily</option>
                                                <option value="Weekly">Weekly</option>
                                                <option value="Monthly">Monthly</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="input1_wrapper">
                                        <label>Pick Up Date and Time</label>
                                        <div class="input1_inner">
                                            <input id="pickup_date" name="pickup_date" type="text" class="form-control input" placeholder="Pick Up Date and Time" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="input1_wrapper">
                                        <label>Return Date and Time</label>
                                        <div class="input1_inner">
                                            <input id="return_date" name="return_date" type="text" class="form-control input" placeholder="Return Date and Time" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 form-group">
                                    <textarea name="message" id="message" cols="30" rows="4" placeholder="Additional Note"></textarea>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <button type="submit" class="btn contact__btn">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
