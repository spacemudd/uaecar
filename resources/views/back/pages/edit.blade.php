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
                            <form action="{{ route('admin.cars.update', $car->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')

                                <div class="form-group col-md-6 col-lg-4">
                                    <label for="node_system_id">Node System ID:</label>
                                    <input type="number" class="form-control" name="node_system_id" value="{{ $car->node_id }}">
                                </div>

                                <div class="form-group col-md-6 col-lg-4">
                                    <label for="car_name">Car Name</label>
                                    <input type="text" name="car_name" class="form-control" value="{{ $car->car_name }}" >
                                </div>

                                <div class="form-group">
                                    <label for="model">Model</label>
                                    <input type="text" name="model" class="form-control" value="{{ $car->model }}" >
                                </div>

                                <div class="form-group">
                                    <label for="seats">Seats</label>
                                    <input type="number" name="seats" class="form-control" value="{{ $car->seats }}" >
                                </div>

                                <div class="form-group">
                                    <label for="price_daily">Price Daily (AED)</label>
                                    <input type="number" name="price_daily" class="form-control" value="{{ $car->price_daily }}" >
                                </div>

                                <div class="form-group">
                                    <label for="price_weekly">Price Weekly (AED)</label>
                                    <input type="number" name="price_weekly" class="form-control" value="{{ $car->price_weekly }}" >
                                </div>

                                <div class="form-group">
                                    <label for="price_monthly">Price Monthly (AED)</label>
                                    <input type="number" name="price_monthly" class="form-control" value="{{ $car->price_monthly }}" >
                                </div>

                                <div class="form-group">
                                    <label for="year">Year</label>
                                    <input type="number" name="year" class="form-control" value="{{ $car->year }}" >
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" class="form-control" rows="3">{{ $car->description }}</textarea>
                                </div>


                                <div class="form-group">
                                    <label for="plate_number">Plate Number</label>
                                    <input type="text" name="plate_number" class="form-control" value="{{ $car->plate_number }}" >
                                </div>

                                <div class="form-group">
                                    <label for="car_picture">Car Image</label>
                                    <input type="file" name="car_picture" class="form-control">
                                </div>

                                <button type="submit" class="btn btn-primary">Update Car</button>
                                <a href="{{ route('admin.cars.index') }}" class="btn btn-secondary">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
