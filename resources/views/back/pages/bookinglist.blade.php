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
                                            <th>ID</th>
                                            <th>Customer Name</th>
                                            <th>Customer Email</th>
                                            <th>Phone Number</th>
                                            <th>Pickup Date</th>
                                            <th>Return Date</th>
                                            <th>Total Amount</th>
                                            <th>Actions</th> <!-- New column for icons -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($invoices as $request)
                                            <tr>
                                                <td>{{ $request->id }}</td>
                                                <td>{{ $request->customer_name }}</td>
                                                <td>{{ $request->customer_email }}</td>
                                                <td>{{ $request->customer_phone }}</td>
                                                <td>{{ $request->pickup_date }}</td>
                                                <td>{{ $request->return_date }}</td>
                                                <td>{{ $request->total_amount }}</td>
                                                <td>
                                                    <!-- View Icon -->
                                                    <a href="{{ route('admin.show.invoice', ['id' => $request->id]) }}" title="View Details">
                                                        <i class="fas fa-eye"></i>
                                                    </a>

                                                  
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
