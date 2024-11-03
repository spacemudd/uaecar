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

                                <!-- Existing fields... -->

                                <div class="form-group col-md-6 col-lg-4">
                                    <label for="category">Category:</label>
                                    <select name="category" class="form-control">
                                        <option value="Luxury" {{ old('category', $car->category) == 'Luxury' ? 'selected' : '' }}>Luxury</option>
                                        <option value="Premium" {{ old('category', $car->category) == 'Premium' ? 'selected' : '' }}>Premium</option>
                                        <option value="Economy" {{ old('category', $car->category) == 'Economy' ? 'selected' : '' }}>Economy</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6 col-lg-4">
                                    <label for="color">Color:</label>
                                    <select name="color" class="form-control">
                                        <option value="Red" {{ old('color', $car->color) == 'Red' ? 'selected' : '' }}>Red</option>
                                        <option value="Blue" {{ old('color', $car->color) == 'Blue' ? 'selected' : '' }}>Blue</option>
                                        <option value="Green" {{ old('color', $car->color) == 'Green' ? 'selected' : '' }}>Green</option>
                                        <option value="Black" {{ old('color', $car->color) == 'Black' ? 'selected' : '' }}>Black</option>
                                        <option value="White" {{ old('color', $car->color) == 'White' ? 'selected' : '' }}>White</option>
                                        <option value="Gray" {{ old('color', $car->color) == 'Gray' ? 'selected' : '' }}>Gray</option>
                                    </select>
                                </div>

                                <!-- Remaining fields... -->

                                <button type="submit" class="btn btn-primary">Update Car</button>
                                <a href="{{ route('admin.carlist') }}" class="btn btn-secondary">Cancel</a>
                            </form>

                            <!-- Separate section for deleting gallery images -->
                            <div class="mt-4">
                                <h5>Current Gallery Images</h5>
                                <div class="row">
                                    @if($images && $images->count() > 0)
                                        @foreach($images as $image)
                                            <div class="col-md-3 mb-2">
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
