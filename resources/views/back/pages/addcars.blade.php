@extends('back.layouts.master') <!-- Assuming you have a layout file -->

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Add New Car</div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.cars.store') }}" method="POST" enctype="multipart/form-data" class="row" onsubmit="return validateForm()">
                        @csrf
                            <div class="form-group col-md-6 col-lg-4">
                                <label for="node_system_id">Node System ID:</label>
                                <input type="text" class="form-control" id="node_system_id" name="node_system_id">
                            </div>
                            <div class="form-group col-md-6 col-lg-4">
                                <label for="car_name">Car Name:</label>
                                <input type="text" class="form-control" id="car_name" name="car_name" required>
                            </div>
                            <div class="form-group col-md-6 col-lg-4">
                                <label for="car_model_name">Car Model Name:</label>
                                <input type="text" class="form-control" id="model" name="model" required>
                            </div>
                            <div class="form-group col-md-6 col-lg-4">
                                <label for="car_model_year">Car Model Year:</label>
                                <input type="number" class="form-control" id="year" name="year" required>
                            </div>
                            <div class="form-group col-md-6 col-lg-4">
                                <label for="plate_number">Plate Number:</label>
                                <input type="text" class="form-control" id="plate_number" name="plate_number">
                            </div>
                            <div class="form-group col-md-6 col-lg-4">
                                <label for="categories">Categories:</label>
                                <select class="form-control" id="categories" name="categories">
                                    <option value="Luxury">Luxury</option>
                                    <option value="Premium">Mid Range</option>
                                    <option value="Economy">Economy</option>
                                    <option value="Sports">Sports and Exotics</option>
                                    <option value="Vans">Vans and Buses</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6 col-lg-4">
                                <label for="seats">Seats:</label>
                                <input type="number" class="form-control" id="seats" name="seats" required>
                            </div>
                            <div class="form-group col-md-6 col-lg-4">
                                <label for="doors">Doors:</label>
                                <input type="number" class="form-control" id="doors" name="doors" required>
                            </div>

                            <div class="form-group col-md-6 col-lg-4">
                                <label for="color">Color:</label>
                                <select class="form-control" id="color" name="color">
                                    <option value="Red">Red</option>
                                    <option value="Blue">Blue</option>
                                    <option value="Green">Green</option>
                                    <option value="Black">Black</option>
                                    <option value="White">White</option>
                                    <option value="Gray">Gray</option> <!-- Added Gray here -->
                                </select>
                            </div>
                            <div class="form-group col-md-6 col-lg-4">
                                <label for="car_price_daily">Car Price Daily:</label>
                                <input type="number" class="form-control" id="price_daily" name="price_daily" step="0.01" required>
                            </div>
                            <div class="form-group col-md-6 col-lg-4">
                                <label for="price_weekly">Car Price Weekly:</label>
                                <input type="number" class="form-control" id="price_weekly" name="price_weekly" step="0.01" required>
                            </div>
                            <div class="form-group col-md-6 col-lg-4">
                                <label for="price_monthly">Car Price Monthly:</label>
                                <input type="number" class="form-control" id="price_monthly" name="price_monthly" step="0.01" required>
                            </div>
                            
                            <div class="form-group col-md-6 col-lg-4">
                                <label for="gear">Gear:</label>
                                <select class="form-control" id="gear" name="gear">
                                    <option value="Automatic" selected>Automatic</option>
                                    <option value="Manual">Manual</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6 col-lg-4">
                                <label for="description">Description:</label>
                                <textarea class="form-control" id="description" name="description"></textarea>
                            </div>
                            <div class="form-group col-md-6 col-lg-4">
                                <label for="chassis_number">Chassis Number:</label>
                                <input type="text" class="form-control" id="chassis_number" name="chassis_number">
                            </div>
                            <div class="form-group col-md-6 col-lg-4">
                                <label for="car_picture">Car Image:</label>
                                <input type="file" class="form-control" id="car_picture" name="car_picture" accept="image/*" required>
                            </div>
                            <div class="form-group col-md-6 col-lg-4">
                                <label for="car_gallery">Car Gallery:</label>
                                <input type="file" class="form-control" id="car_gallery" name="car_gallery[]" accept="image/*" multiple>
                            </div>

                            <div class="form-group col-md-6 col-lg-4">
                                <label for="kilo_daily">Kilo Daily:</label>
                                <input type="number" class="form-control" id="kilo_daily" name="kilo_daily" step="0.01" value="450">
                            </div>
                            <div class="form-group col-md-6 col-lg-4">
                                <label for="kilo_monthly">Kilo Monthly:</label>
                                <input type="number" class="form-control" id="kilo_monthly" name="kilo_monthly" value="4500">
                            </div>

                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function validateForm() {
        let isValid = true;
        const requiredFields = document.querySelectorAll('input[required], select[required], textarea[required]');
        
        requiredFields.forEach(field => {
            if (!field.value) {
                field.classList.add('is-invalid');
                isValid = false;
            } else {
                field.classList.remove('is-invalid');
            }
        });

        if (!isValid) {
            alert('Please fill out all required fields.');
        }

        return isValid;
    }
</script>

@endsection
