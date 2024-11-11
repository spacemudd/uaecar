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

            <!-- Add "Delete All" button above the table -->
            <div class="row mb-3">
                <div class="col-md-12">
                    <form action="{{ route('booking-requests.deleteAll') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete all booking requests?')">
                            <i class="fas fa-trash-alt"></i> Delete All Booking Requests
                        </button>
                    </form>
                </div>
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
                                            <th>ID</th>
                                            <th>Request Number</th>
                                            <th>Car Name</th>
                                            <th>Phone Number</th>
                                            <th>Email</th>
                                            <th>Pickup Date</th>
                                            <th>Return Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($booking_request as $request)
                                            <tr onclick="window.location='{{ route('booking-requests.show', $request->id) }}'" style="cursor: pointer;">
                                                <td>{{ $request->id }}</td>
                                                <td>{{ $request->request_number }}</td>
                                                <td>{{ $request->car_name }}</td>
                                                <td>{{ $request->phone }}</td>
                                                <td>{{ $request->email }}</td>
                                                <td>{{ $request->pickup_date }}</td>
                                                <td>{{ $request->return_date }}</td>
                                                <td>
                                                    <span class="badge 
                                                        @if($request->status == 'Pending')
                                                            bg-warning text-dark
                                                        @elseif($request->status == 'Approved')
                                                            bg-success text-white
                                                        @elseif($request->status == 'Canceled')
                                                            bg-danger text-white
                                                        @else
                                                            bg-secondary text-white
                                                        @endif
                                                    ">
                                                        {{ $request->status }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <form action="#" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('PATCH')
                                                    </form>
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <form action="#" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger" title="Delete">
                                                                <i class="fas fa-trash-alt"></i> <!-- Font Awesome trash icon -->
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
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
