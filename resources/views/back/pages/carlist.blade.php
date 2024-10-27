@extends('back.layouts.master')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<div class="wrapper">
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Car List</h3>
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
                        <a href="#">Car List</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Car List Table</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <table id="example" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>NODE ID</th>
                                            <th>Car Name</th>
                                            <th>Seats</th>
                                            <th>Price Daily</th>
                                            <th>Price Weekly</th>
                                            <th>Price Monthly</th>
                                            <th>Car Image</th>
                                            <th>Year</th>
                                            <!-- <th>Color</th> -->
                                            <th>Plate Number</th>
                                            <th>Visible</th> <!-- New column for visibility -->
                                            <th>Actions</th> <!-- Actions column -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cars as $car)
                                            <tr>
                                                <td>{{ $car->node_id }}</td>
                                                <td>{{ $car->car_name . ' ' . $car->model }}</td>
                                                <td>{{ $car->seats }}</td>
                                                <td>{{ $car->price_daily . ' AED' }}</td>
                                                <td>{{ $car->price_weekly . ' AED' }}</td>
                                                <td>{{ $car->price_monthly . ' AED' }}</td>
                                                <td><img src="{{ asset('storage/' . $car->car_picture) }}" alt="Car Image" style="width: 100px; height: auto;"></td>
                                                <td>{{ $car->year }}</td>
                                                <!-- <td>{{ $car->color }}</td> -->
                                                <td>{{ $car->plate_number }}</td>
                                                <td>
                                                <form action="{{ route('admin.cars.toggleVisibility', $car->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('PATCH')
                                                    <label>
                                                        <input type="checkbox" onchange="this.form.submit()" {{ $car->is_visible ? 'checked' : '' }}>
                                                        <i class="fas {{ $car->is_visible ? 'fa-eye' : 'fa-eye-slash' }}" title="{{ $car->is_visible ? 'Hide' : 'Show' }}"></i>
                                                    </label>
                                                </form>
                                                                                                </td>
                                                <td>
                                                    <!-- Add any actions, like edit or delete -->
                                                    <div class="d-inline-block">
                                                    <a href="{{ route('admin.cars.edit', $car->id) }}" class="btn btn-info" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                        <form action="{{ route('admin.cars.delete', $car->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger" title="Delete">
                                                                <i class="fas fa-trash-alt"></i> <!-- Font Awesome trash icon -->
                                                            </button>
                                                        </form>
                                                    </div>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
