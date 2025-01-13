<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="{{ $id }}Label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="{{ $id }}Label">{{ $title }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="booking-box">
                                            <div class="booking-inner clearfix">
                                                <form method="post" action="{{ route('form.submit') }}" class="form1 contact__form clearfix" id="bookingForm">
                                                    @csrf
                                                        <div class="col-12">
                                                            <div class="alert alert-success contact__msg" style="display: none" role="alert"> Your message was sent successfully. </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
 
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
                                                                    <select id="bookingDuration" name="booking_duration" class="select2 select" style="width: 100%" required>
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
                                                        <div id="returnDateField" class="col-lg-6 col-md-12">
                                                            <div class="input1_wrapper">
                                                                <label>Return Date and Time</label>
                                                                <div class="input1_inner">
                                                                    <input id="returnDate" name="return_date" type="text" class="form-control input" placeholder="Return Date and Time" required>
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
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- إضافة جافا سكربت للتحكم في ظهور الحقل -->
<script>
  // استمع لتغيير اختيار الدروب داون
  document.querySelectorAll('[id^="modalExample"]').forEach(modal => {
  const carId = modal.id.replace("modalExample", "");
  modal.querySelector(`#dropdown${carId}`).addEventListener('change', function() {
    var selectedOption = this.value;
    var readonlyFieldContainer = modal.querySelector(`#readonlyFieldContainer${carId}`);

    // إذا كان الخيار الثالث تم اختياره، اخف الحقل
    if (selectedOption === 'option3') {
      readonlyFieldContainer.style.display = 'none';
    } else {
      readonlyFieldContainer.style.display = 'block';
    }
  });
});

</script>
