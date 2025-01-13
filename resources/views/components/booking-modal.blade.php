<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<div class="modal fade" id="bookingModal{{ $car->id }}" tabindex="-1" aria-labelledby="bookingModalLabel{{ $car->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="bookingModalLabel{{ $car->id }}">Booking Form for {{ $car->car_name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="booking-box">
                                            <div class="booking-inner clearfix">
                                                <form method="post" action="{{ route('form.submit') }}" class="form1 contact__form clearfix" id="bookingForm">
                                                    @csrf
                                                    <input type="hidden" name="car_id" value="{{ $car->id }}">
                                                    <img src="{{ asset('storage/' . $car->car_picture) }}" alt="Car Picture" />
                                                    <input type="hidden" name="car_picture" value="{{ asset('storage/' . $car->car_picture) }}">                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="alert alert-success contact__msg" style="display: none" role="alert"> Your message was sent successfully. </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-12">
                                                            <label>Car Name</label>
                                                            <input name="carName" type="hidden" class="form-control" value="{{ $car->car_name . ' ' . $car->model . ' ' . $car->year }}" readonly>
                                                        </div>
                                                        <div class="col-lg-6 col-md-12">
                                                            <label>Car ID</label>
                                                            <input type="hidden" class="form-control" value="{{ $car->id }}" name="carID" readonly>
                                                        </div>
                                                        <input type="hidden" name="plate_number" value="{{ $car->plate_number }}">
                                                        <input type="hidden" name="price_daily" value="{{ $car->price_daily }}">
                                                        <input type="hidden" name="price_weekly" value="{{ $car->price_weekly }}">
                                                        <input type="hidden" name="price_monthly" value="{{ $car->price_monthly }}">

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
                                                        <div id="returnDateField{{ $car->id }}" class="col-lg-6 col-md-12">

                                                            <div class="input1_wrapper">
                                                                <label>Return Date and Time</label>
                                                                <div class="input1_inner">
                                                                    <input id="returnDate{{ $car->id }}" name="return_date" type="text" class="form-control input" placeholder="Return Date and Time" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12 col-md-12 form-group">
                                                            <textarea name="message" id="message" cols="30" rows="4" placeholder="Additional Note"></textarea>
                                                        </div>

                                                        <div class="col-lg-12 col-md-12">
                                                            <input type="hidden" name="daily_car_price" value="{{ $car->price_daily }}">
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



<script>

$(document).ready(function () {
    $('[id^="bookingDuration"]').each(function () {
        const bookingDuration = $(this);
        const modalId = bookingDuration.attr('id').replace('bookingDuration', '');
        const returnDateField = $('#returnDateField' + modalId);
        const returnDateInput = $('#returnDate' + modalId);

        // دالة لتحديث حقل تاريخ العودة
        function updateReturnDateField() {
            if (bookingDuration.val() === 'Weekly' || bookingDuration.val() === 'Monthly') {
                returnDateField.hide(); // إخفاء الحقل
                returnDateInput.prop('required', false); // إزالة required
            } else {
                returnDateField.show(); // عرض الحقل
                returnDateInput.prop('required', true); // إضافة required
            }
        }

        // تحديث الحقل عند تغيير القيمة
        bookingDuration.change(function () {
            updateReturnDateField();
            
            // إرسال البيانات عبر AJAX لتحديث الحقول أو التعامل مع البيانات
            $.ajax({
                url: '/update-booking-duration', // المسار الخاص بك في Laravel
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'), // CSRF token
                    car_id: modalId,
                    booking_duration: bookingDuration.val()
                },
                success: function (data) {
                    // هنا يمكنك إضافة أي معالجة إضافية للبيانات إذا لزم الأمر
                    console.log('Booking duration updated successfully');
                },
                error: function (xhr, status, error) {
                    console.error('Error updating booking duration: ', error);
                }
            });
        });

        // تحديث الحقل عند تحميل الصفحة
        updateReturnDateField();
    });
});



</script>