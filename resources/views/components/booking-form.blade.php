                <!-- Booking Modal -->
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
                                                            <input name="return_date" type="text" class="form-control input datepicker" placeholder="Return Date">
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
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>