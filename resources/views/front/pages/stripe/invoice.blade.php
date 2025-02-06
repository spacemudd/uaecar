<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-11504797989"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'AW-11504797989');
</script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="card">
        <div class="card-body">
            <div class="container mb-5 mt-3">
                <div class="row d-flex align-items-baseline">
                    <div class="col-xl-9">
                        <p style="color: #7e8d9f;font-size: 20px;">Invoice >> <strong>ID: #{{ $invoice->id }}</strong></p>
                    </div>
                    <div class="col-xl-3 text-end">
                        <!-- Print Button -->
                        <button class="btn btn-light text-capitalize border-0" onclick="window.print()">
                            <i class="fas fa-print text-primary"></i> Print
                        </button>
                    </div>
                </div>
                <hr>
                <div class="container">
                    <div class="col-md-12 text-center">
                        <img src="{{ asset('front/img/black.png') }}" alt="Invoice Logo" class="img-fluid" style="max-width: 700px;">
                    </div>
                    <div class="row">
                        <div class="col-xl-8">
                            <ul class="list-unstyled">
                                <li class="text-muted">Invoice To: <span style="color:#5d9fc5;">{{ $invoice->customer_name }}</span></li>
                                <li class="text-muted">Pickup City: {{ $invoice->city }}</li>
                                <li class="text-muted">Pickup Date: {{ $invoice->pickup_date }}</li>
                                <li class="text-muted">Return Date: {{ $invoice->return_date }}</li>
                                <li class="text-muted">Phone Number: {{ $invoice->customer_phone }}</li>

                            </ul>
                        </div>
                        <div class="col-xl-4">
                            <p class="text-muted">Invoice</p>
                            <ul class="list-unstyled">
                                <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA;"></i> <span class="fw-bold">ID:</span> #{{ $invoice->id }}</li>
                                <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA;"></i> <span class="fw-bold">Creation Date:</span> {{ $invoice->creation_date }}</li>
                                <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA;"></i> <span class="fw-bold">Status:</span> <span class="badge bg-success text-white fw-bold">{{ ucfirst($invoice->status) }}</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row my-2 mx-1 justify-content-center">
                        <table class="table table-striped table-borderless">
                            <thead style="background-color:#84B0CA;" class="text-white">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Total Days</th>
                                    <th scope="col">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>{{ $invoice->description  }}</td>
                                    <td>{{ $invoice->total_days }}</td>
                                    <td>{{ $invoice->total_amount }} AED</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-xl-8">
                        </div>
                        <div class="col-xl-3">
                            <ul class="list-unstyled">
                                <li class="text-muted ms-3"><span class="text-black me-4">SubTotal</span>{{ $invoice->total_amount }} AED</li>
                                <li class="text-muted ms-3 mt-2"><span class="text-black me-4">Deposit (Security)</span>AED {{ $invoice->tax }}</li>
                            </ul>
                            <p class="text-black float-start"><span class="text-black me-3">Total Amount</span><span style="font-size: 25px;">{{ $invoice->total_amount + $invoice->tax }} AED</span></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xl-10">
                            <p>Thank you for your purchase</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
