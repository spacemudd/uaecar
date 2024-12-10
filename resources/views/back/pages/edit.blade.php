@extends('back.layouts.master')

@section('content')
<div class="wrapper">
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Edit Car Details</h3>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.cars.update', $car->id) }}" method="POST" enctype="multipart/form-data" class="row" onsubmit="return validateForm()">
                                @csrf
                                @method('PATCH')

                                <div class="form-group col-md-6 col-lg-4">
                                    <label for="node_system_id">Node System ID:</label>
                                    <input type="text" class="form-control" name="node_system_id" value="{{ old('node_system_id', $car->node_id) }}">
                                </div>


                                <div class="form-group col-md-6 col-lg-4">
                                    <label for="car_name">Car Name</label>
                                    <input type="text" name="car_name" class="form-control" value="{{ old('car_name', $car->car_name) }}">
                                </div>

                                <div class="form-group col-md-6 col-lg-4">
                                    <label for="model">Model</label>
                                    <input type="text" name="model" class="form-control" value="{{ old('model', $car->model) }}">
                                </div>

                                <div class="form-group col-md-6 col-lg-4">
                                    <label for="seats">Seats</label>
                                    <input type="number" name="seats" class="form-control" value="{{ old('seats', $car->seats) }}">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="doors">Number of Doors:</label>
                                    <input type="number" class="form-control" id="doors" name="doors" value="{{ old('doors', $car->doors) }}" min="2" max="5">
                                </div>


                                <div class="form-group col-md-6 col-lg-4">
                                    <label for="price_daily">Price Daily (AED)</label>
                                    <input type="number" name="price_daily" class="form-control" value="{{ old('price_daily', $car->price_daily) }}">
                                </div>

                                <div class="form-group col-md-6 col-lg-4">
                                    <label for="price_weekly">Price Weekly (AED)</label>
                                    <input type="number" name="price_weekly" class="form-control" value="{{ old('price_weekly', $car->price_weekly) }}">
                                </div>

                                <div class="form-group col-md-6 col-lg-4">
                                    <label for="price_monthly">Price Monthly (AED)</label>
                                    <input type="number" name="price_monthly" class="form-control" value="{{ old('price_monthly', $car->price_monthly) }}">
                                </div>

                                <div class="form-group col-md-6 col-lg-4">
                                    <label for="year">Year</label>
                                    <input type="number" name="year" class="form-control" value="{{ old('year', $car->year) }}">
                                </div>

                                <div class="form-group col-md-6 col-lg-4">
                                    <label for="description">Description</label>
                                    <textarea name="description" class="form-control" rows="3">{{ old('description', $car->description) }}</textarea>
                                </div>


                                <div class="form-group col-md-6 col-lg-4">
                                    <label for="plate_number">Plate Number</label>
                                    <input type="text" name="plate_number" class="form-control" value="{{ old('plate_number', $car->plate_number) }}">
                                </div>

                                <div class="form-group col-md-6 col-lg-4">
                                    <label for="chassis_number">Chassis Number</label>
                                    <input type="text" name="chassis_number" class="form-control" value="{{ old('chassis_number', $car->chassis_number) }}">
                                </div>
                                
                                <div class="form-group col-md-6 col-lg-4">
                                    <label for="kilo_daily">Kilo Daily</label>
                                    <input type="number" name="kilo_daily" class="form-control" value="{{ old('kilo_daily', $car->kilo_daily) }}">
                                </div>

                                <div class="form-group col-md-6 col-lg-4">
                                    <label for="categories">Categories:</label>
                                    <select class="form-control" id="categories" name="categories">
                                        <option value="luxury" {{ old('categories', $categoryValue) == 'luxury' ? 'selected' : '' }}>Luxury</option>
                                        <option value="mid range" {{ old('categories', $categoryValue) == 'mid range' ? 'selected' : '' }}>Mid Range</option>
                                        <option value="economy" {{ old('categories', $categoryValue) == 'economy' ? 'selected' : '' }}>Economy</option>
                                        <option value="sports and exotics" {{ old('categories', $categoryValue) == 'Sports and Exotics' ? 'selected' : '' }}>Sports and Exotics</option>
                                        <option value="vans and buses" {{ old('categories', $categoryValue) == 'Vans and Buses' ? 'selected' : '' }}>Vans and Buses</option>

                                    </select>
                                </div>




                                <div class="form-group col-md-6 col-lg-4">
                                    <label for="color">Color:</label>
                                    <select class="form-control" id="color" name="color">
                                        @foreach ($colors as $color)
                                            <option value="{{ $color }}" {{ old('color', $currentColor) == $color ? 'selected' : '' }}>
                                                {{ $color }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>


             
                                <div class="form-group col-md-6 col-lg-4">
                                    <label for="kilo_monthly">Kilo Monthly</label>
                                    <input type="number" name="kilo_monthly" class="form-control" value="{{ old('kilo_monthly', $car->kilo_monthly) }}">
                                </div>


                                <div class="form-group col-md-6 col-lg-4">
                                    <label for="car_picture">Car Image</label>
                                    <input type="file" name="car_picture" class="form-control">
                                    
                                    @if($car->car_picture)
                                        <div class="mt-2">
                                            <img src="{{ asset('storage/' . $car->car_picture) }}" alt="Current Car Image" style="max-width: 200px; max-height: 150px; object-fit: cover;">
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 col-lg-4">
                                    <label for="car_gallery">Car Gallery Images</label>
                                    <input type="file" name="car_gallery[]" class="form-control" multiple>
                                </div>

                                <button type="submit" class="btn btn-primary">Update Car</button>
                                <a href="{{ route('admin.carlist') }}" class="btn btn-secondary">Cancel</a>
                            </form>

                            <!-- Separate section for deleting gallery images -->
                            <div class="mt-4">
                                <h5>Current Gallery Images</h5>
                                <div class="row">
                                    @if($images && $images->count() > 0)
                                        @foreach($images as $image)
                                            <div class="col-md-3 mb-2"> <!-- Adjust the column size as needed -->
                                                <div class="card">
                                                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="Current Car Image" class="card-img-top" style="max-width: 100%; height: auto; object-fit: cover;">
                                                    <div class="card-body text-center">
                                                        <form action="{{ route('admin.cars.gallery.delete', $image->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <p>No images available.</p>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
