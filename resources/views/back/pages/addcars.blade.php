@extends('back.layouts.master')
@section('content')

    <div class="wrapper">


        <div class="container">
          <div class="page-inner">
            <div class="page-header">
              <h3 class="fw-bold mb-3">Add New Car</h3>
              <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                  <a href="#">
                    <i class="icon-home"></i>
                  </a>
                </li>
                <li class="separator">
                  <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                  <a href="#">Cars</a>
                </li>
                <li class="separator">
                  <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                  <a href="#">Add New Car</a>
                </li>
              </ul>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Add New Car</div>
                  </div>
                  <div class="card-body">
                    <div class="row">
                    <div class="col-md-6 col-lg-4">
                        <!-- Node System ID -->
                        <div class="form-group">
                            <label for="email2">Node System ID</label>
                            <input
                                type="text"
                                class="form-control"
                                id="email2"
                                placeholder="Enter Node System ID"
                                required
                            />
                        </div>

                        <!-- Car Name -->
                        <div class="form-group">
                            <label for="car_name">Car Name</label>
                            <input
                                type="text"
                                class="form-control"
                                id="car_name"
                                placeholder="Enter Car Name"
                                required
                            />
                        </div>

                        <!-- Car Model -->
                        <div class="form-group form-inline">
                            <label for="car_model" class="col-md-3 col-form-label">Car Model</label>
                            <div class="col-md-9 p-0">
                                <input
                                    type="text"
                                    class="form-control input-full"
                                    id="car_model"
                                    placeholder="Enter Car Model"
                                    required
                                />
                            </div>
                        </div>

                        <!-- Car Model Year -->
                        <div class="form-group form-inline">
    <label for="car_model_year" class="col-md-3 col-form-label">Car Model Year</label>
    <div class="col-md-9 p-0">
        <select class="form-control input-full" id="car_model_year" name="car_model_year" required>
            <option value="">Select Car Model Year</option>
            @for ($year = date('Y'); $year >= 1990; $year--)
                <option value="{{ $year }}">{{ $year }}</option>
            @endfor
        </select>
    </div>
</div>


                        <!-- Plate Number -->
                        <div class="form-group">
                            <label for="plate_number">Plate Number</label>
                            <input
                                type="text"
                                class="form-control"
                                id="plate_number"
                                placeholder="Enter Car Plate Number"
                                required
                            />
                        </div>

                        <!-- Categories -->
                        <div class="form-group">
                            <label for="categories">Categories</label>
                            <select class="form-control" id="categories">
                                <option value="">Select Category</option>
                                <option value="Normal">Normal</option>
                                <option value="Luxury">Luxury</option>
                            </select>
                        </div>
                    </div>



                    <div class="col-md-6 col-lg-4">
    <!-- Seats -->
            <div class="form-group">
                <label for="seats">Seats</label>
                <input
                    type="number"
                    class="form-control"
                    id="seats"
                    placeholder="Enter Car Seats"
                    required
                />
            </div>

    <!-- Doors -->
        <div class="form-group">
            <label for="doors">Car Doors</label>
            <input
                type="number"
                class="form-control"
                id="doors"
                placeholder="Enter Car Doors"
                required
            />
        </div>

    <!-- Car Price Daily -->
    <div class="form-group">
    <label for="price_daily">Car Price Daily</label>
    <div class="input-group mb-3">
        <span class="input-group-text">AED</span>
        <input
            type="number"
            class="form-control"
            id="price_daily"
            name="price_daily"
            aria-label="Amount (to the nearest dollar)"
            required
        />
        <span class="input-group-text">.00</span>
    </div>
</div>


    <!-- Car Price Weekly -->
        <div class="form-group">
            <label for="price_weekly">Car Price Weekly</label>
            <div class="input-group mb-3">
                <span class="input-group-text">AED</span>
                <input
                    type="number"
                    class="form-control"
                    id="price_weekly"
                    aria-label="Amount (to the nearest dollar)"
                    required
                />
                <span class="input-group-text">.00</span>
            </div>
        </div>

    <!-- Car Price Monthly -->
        <div class="form-group">
            <label for="price_monthly">Car Price Monthly</label>
            <div class="input-group mb-3">
                <span class="input-group-text">AED</span>
                <input
                    type="number"
                    class="form-control"
                    id="price_monthly"
                    aria-label="Amount (to the nearest dollar)"
                    required
                />
                <span class="input-group-text">.00</span>
            </div>
        </div>

    <!-- Color Input -->
        <div class="form-group">
            <label class="form-label">Color Input</label>
            <div class="row gutters-xs">
                <!-- Color: Black -->
                <div class="col-auto">
                    <label class="colorinput">
                        <input
                            name="color"
                            type="checkbox"
                            value="dark"
                            class="colorinput-input"
                        />
                        <span class="colorinput-color bg-black"></span>
                    </label>
                </div>
                <!-- Color: Primary -->
                <div class="col-auto">
                    <label class="colorinput">
                        <input
                            name="color"
                            type="checkbox"
                            value="primary"
                            class="colorinput-input"
                        />
                        <span class="colorinput-color bg-primary"></span>
                    </label>
                </div>
                <!-- Color: Secondary -->
                <div class="col-auto">
                    <label class="colorinput">
                        <input
                            name="color"
                            type="checkbox"
                            value="secondary"
                            class="colorinput-input"
                        />
                        <span class="colorinput-color bg-secondary"></span>
                    </label>
                </div>
                <!-- Color: Info -->
                <div class="col-auto">
                    <label class="colorinput">
                        <input
                            name="color"
                            type="checkbox"
                            value="info"
                            class="colorinput-input"
                        />
                        <span class="colorinput-color bg-info"></span>
                    </label>
                </div>
                <!-- Color: Success -->
                <div class="col-auto">
                    <label class="colorinput">
                        <input
                            name="color"
                            type="checkbox"
                            value="success"
                            class="colorinput-input"
                        />
                        <span class="colorinput-color bg-success"></span>
                    </label>
                </div>
                <!-- Color: Danger -->
                <div class="col-auto">
                    <label class="colorinput">
                        <input
                            name="color"
                            type="checkbox"
                            value="danger"
                            class="colorinput-input"
                        />
                        <span class="colorinput-color bg-danger"></span>
                    </label>
                </div>
                <!-- Color: Warning -->
                <div class="col-auto">
                    <label class="colorinput">
                        <input
                            name="color"
                            type="checkbox"
                            value="warning"
                            class="colorinput-input"
                        />
                        <span class="colorinput-color bg-warning"></span>
                    </label>
                </div>
            </div>
        </div>
        </div>

                      <div class="col-md-6 col-lg-4">

                      <div class="form-group form-inline">
    <label for="car_transmission" class="col-md-3 col-form-label">Transmission Type</label>
    <div class="col-md-9 p-0">
        <select class="form-control input-full" id="car_transmission" name="car_transmission" required>
            <option value="">Select Transmission Type</option>
            <option value="Automatic">Automatic</option>
            <option value="Manual">Manual</option>
        </select>
    </div>
</div>

    <div class="form-group form-inline">
            <label for="car_description" class="col-md-3 col-form-label">Description</label>
            <div class="col-md-9 p-0">
                <textarea class="form-control input-full" id="car_description" placeholder="Enter Description" rows="4" required></textarea>
            </div>
    </div>
    <div class="form-group">
        <label for="status">Status</label>
        <input 
            type="text" 
            class="form-control" 
            id="status" 
            value="Available" 
            readonly
            />
    </div>

    <div class="form-group">
        <label for="chassis_number">Chassis Number</label>
        <input 
            type="text" 
            class="form-control" 
            id="chassis_number" 
            placeholder="Enter Chassis Number"
            
        />
    </div>

    <div class="form-group">
        <label for="car_image">Car Image</label>
        <input 
            type="file" 
            class="form-control" 
            id="car_image" 
            accept="image/*" 
            required
        />
    </div>

    <div class="form-group">
        <label for="car_gallery">Car Gallery</label>
        <input 
            type="file" 
            class="form-control" 
            id="car_gallery" 
            accept="image/*" 
            required />

            <input 
            type="file" 
            class="form-control" 
            id="car_gallery" 
            accept="image/*" 
            required />

            <input 
            type="file" 
            class="form-control" 
            id="car_gallery" 
            accept="image/*" 
            required />

            <input 
            type="file" 
            class="form-control" 
            id="car_gallery" 
            accept="image/*" 
            required />
</div>
                  </div>
                  <div class="card-action">
                  <button type="button" class="btn btn-success" onclick="validateForm()">Submit</button>
                    <button class="btn btn-danger">Cancel</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <!-- End Custom template -->
    </div>


    <script>
function validateForm() {
    const requiredFields = [
        { id: 'node_id', name: 'Node System ID' },
        { id: 'car_model_year', name: 'Car Model Year' },
        { id: 'price_daily', name: 'Car Price Daily' },
        { id: 'car_transmission', name: 'Transmission Type' }
    ];

    const missingFields = requiredFields.filter(field => {
        const element = document.getElementById(field.id);
        return !element.value; // Check if the field is empty
    });

    if (missingFields.length > 0) {
        const fieldNames = missingFields.map(field => field.name).join(', ');
        alert('Please fill out the following required fields: ' + fieldNames);
    } else {
        // If all required fields are filled, submit the form
        document.getElementById('yourFormId').submit(); // Replace with your form ID
    }
}
</script>






@endsection