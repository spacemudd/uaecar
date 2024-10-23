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

                    <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data" class="row">
                        @csrf
                        <div class="form-group col-md-6 col-lg-4">
                            <label for="node_system_id">Node System ID:</label>
                            <input type="number" class="form-control" id="node_system_id" name="node_system_id" required>
                        </div>
                        <div class="form-group col-md-6 col-lg-4">
                            <label for="car_name">Car Name:</label>
                            <input type="text" class="form-control" id="car_name" name="car_name" required>
                        </div>
                        <div class="form-group col-md-6 col-lg-4">
                            <label for="car_model_name">Car Model Name:</label>
                            <input type="text" class="form-control" id="car_model_name" name="car_model_name" required>
                        </div>
                        <div class="form-group col-md-6 col-lg-4">
                            <label for="car_model_year">Car Model Year:</label>
                            <input type="number" class="form-control" id="car_model_year" name="car_model_year" required>
                        </div>
                        <div class="form-group col-md-6 col-lg-4">
                            <label for="plate_number">Plate Number:</label>
                            <input type="text" class="form-control" id="plate_number" name="plate_number" required>
                        </div>
                        <div class="form-group col-md-6 col-lg-4">
                            <label for="categories">Categories:</label>
                            <input type="text" class="form-control" id="categories" name="categories" required>
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
                            <select class="form-control" id="color" name="color" required>
                                <option value="Red">Red</option>
                                <option value="Blue">Blue</option>
                                <option value="Green">Green</option>
                                <option value="Black">Black</option>
                                <option value="White">White</option>
                                <!-- Add more colors as needed -->
                            </select>
                        </div>
                        <div class="form-group col-md-6 col-lg-4">
                            <label for="car_price_daily">Car Price Daily:</label>
                            <input type="number" class="form-control" id="car_price_daily" name="car_price_daily" step="0.01" required>
                        </div>
                        <div class="form-group col-md-6 col-lg-4">
                            <label for="car_price_weekly">Car Price Weekly:</label>
                            <input type="number" class="form-control" id="car_price_weekly" name="car_price_weekly" step="0.01" required>
                        </div>
                        <div class="form-group col-md-6 col-lg-4">
                            <label for="car_price_monthly">Car Price Monthly:</label>
                            <input type="number" class="form-control" id="car_price_monthly" name="car_price_monthly" step="0.01" required>
                        </div>
                        
                        <div class="form-group col-md-6 col-lg-4">
                            <label for="gear">Gear:</label>
                            <select class="form-control" id="gear" name="gear" required>
                                <option value="Automatic" selected>Automatic</option>
                                <option value="Manual">Manual</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6 col-lg-4">
                            <label for="description">Description:</label>
                            <textarea class="form-control" id="description" name="description" required></textarea>
                        </div>
                        <div class="form-group col-md-6 col-lg-4">
                            <label for="chassis_number">Chassis Number:</label>
                            <input type="text" class="form-control" id="chassis_number" name="chassis_number" required>
                        </div>
                        <div class="form-group col-md-6 col-lg-4">
                            <label for="car_image">Car Image:</label>
                            <input type="file" class="form-control" id="car_image" name="car_image" accept="image/*" required>
                        </div>
                        <div class="form-group col-md-6 col-lg-4">
                            <label for="car_gallery">Car Gallery:</label>
                            <input type="file" class="form-control" id="car_gallery" name="car_gallery[]" accept="image/*" multiple required>
                        </div>

                        <div class="form-group col-md-6 col-lg-4">
                            <label for="status">Status:</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="status" name="status" value="show" checked onchange="toggleStatus(this)">
                                <label class="form-check-label" for="status">Show</label>
                            </div>
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
    function toggleStatus(element) {
        const statusValue = element.checked ? 'show' : 'hide';
        document.getElementById('statusInput').value = statusValue;
        element.nextElementSibling.innerText = statusValue.charAt(0).toUpperCase() + statusValue.slice(1);
    }
</script>

@endsection
