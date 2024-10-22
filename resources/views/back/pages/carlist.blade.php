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
                                            <th>Color</th>
                                            <th>Plate Number</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cars as $car )
                                            
                                        <tr>
                                            <td>{{ $car->node_id }}</td>
                                            <td>{{ $car->car_name . ' ' . $car->model }}</td>
                                            <td>{{ $car->seats }}</td>
                                            <td>{{ $car->price_daily . ' AED' }}</td>
                                            <td>{{ $car->price_weekly . ' AED' }}</td>
                                            <td>{{ $car->price_monthly . ' AED' }}</td>
                                            <td>    <img src="{{ asset($car->car_picture) }}" alt="Car Image" style="width: 100px; height: auto;"></td>
                                            <td>{{ $car->year }}</td>
                                            <td>{{ $car->color }}</td>
                                            <td>{{ $car->plate_number }}</td>


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
        </div>
      <!-- End Custom template -->
    </div>

@endsection