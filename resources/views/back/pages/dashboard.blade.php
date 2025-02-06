@extends('back.layouts.master')
@section('content')
<h1>Hello</h1>
  <div class="wrapper">
      <div class="container">
          <div class="page-inner">
              <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                  <div>
                      <h3 class="fw-bold mb-3">Dashboard</h3>
                  </div>

              </div>

              <div class="col">
    <div class="row">
        <div class="col-sm-6 col-md-6"> <!-- Adjust the column size to 6 on medium screens -->
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-primary bubble-shadow-small">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Total Cars</p>
                                <h4 class="card-title">{{$car_count}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-6"> <!-- Same adjustment here for the second card -->
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-primary bubble-shadow-small">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Total Invoices</p>
                                <h4 class="card-title">{{$invoice_count}}</h4>
                            </div>
                        </div>
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
