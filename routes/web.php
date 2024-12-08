<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\FinancingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\indexController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\SellYourCarController;
use App\Http\Controllers\TestimonialsController;
use App\Http\Controllers\Webhooks\AutoTraderReceiverController;
use App\Http\Controllers\WhyUsController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\back\adminDashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\StripeController;
use App\Http\Middleware\VerifyInvoiceAccess;
use App\Http\Controllers\Tabby\TabbyController;
use App\Services\TabbyService;
use App\Models\Car;
use App\Services\AutoTraderService;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Session;
use App\Http\Middleware\SessionAuth;
use App\Http\Controllers\Tabby\CheckoutController;
use App\Mail\TestEmail; // Make sure you have created the TestEmail Mailable
// Route::get('/car/{id}', function() {
//    return Car::find(request()->id);
// });

// Route::get('aa', function() {
//     $car = app()->make(AutoTraderService::class)->stock()['results'][0];

//     return $car['media']['images'];
// });

// Route::get('bb', function() {
//     return Car::first()->at_data;
// });

// Route::put('webhooks/autotrader', [AutoTraderReceiverController::class, 'index']);

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// })->name('home');


//Route::get('/', function () {
//    return Inertia::render('Welcome', [
//        'canLogin' => Route::has('login'),
//        'canRegister' => Route::has('register'),
//        'laravelVersion' => Application::VERSION,
//        'phpVersion' => PHP_VERSION,
//    ]);
//})->name('home');



// Public Routes
Route::get('/', [indexController::class, 'showVisibleCars'])->name('index');
Route::get('/home', [indexController::class, 'showVisibleCars'])->name('index');

Route::get('/contact-us', [CompanyController::class, 'showContact'])->name('contact');
Route::get('/car/{id}', [CarController::class, 'show'])->name('cars.show');

Route::post('form/submit', [FormController::class, 'submit'])->name('form.submit');
Route::post('form/contact', [FormController::class, 'sendContactEmail'])->name('form.contact');
Route::get('/submission-status', [FormController::class, 'submissionStatus'])->name('submission.status');

Route::post('/newsletter', [NewsletterController::class, 'store'])->name('newsletter.store');

Route::get('/appointments/success', [AppointmentsController::class, 'success'])->name('appointments.success');
Route::post('/appointments', [AppointmentsController::class, 'store'])->name('appointments.store');
Route::get('/appointments/create', [AppointmentsController::class, 'create'])->name('appointments.create');

// Route::post('sell-your-car', [SellYourCarController::class, 'store'])->name('sell-your-car.store');

// TODO
Route::get('why-us', [WhyUsController::class, 'index'])->name('why-us.index');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/testimonials', [TestimonialsController::class, 'index'])->name('testimonials.index');
Route::get('/financing', [FinancingController::class, 'index'])->name('financing.index');

Route::get('media/{id}', [MediaController::class, 'show'])->name('media.show');



Route::get('/successview', [StripeController::class, 'successView'])->name('successview');



// Route::post('/login', [LoginController::class, 'login'])->name('login.custom');


// Custom login route
Route::get('admin/login', [LoginController::class, 'showLoginForm'])->name('login');

// Handle custom login POST request
Route::post('login', [LoginController::class, 'login'])->name('login.custom');

// You can add a custom route to handle logout
Route::post('logout', [LoginController::class, 'logout'])->name('logout');



Route::middleware('auth:admin')->group(function () {

    // Admin Dashboard Routes
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/add-new-car', [AdminDashboardController::class, 'addCars'])->name('admin.form');
    Route::get('/admin/carlist', [AdminDashboardController::class, 'showCarList'])->name('admin.carlist'); 
    
    // Car Management Routes
    Route::patch('/admin/cars/{id}/toggle-visibility', [CarController::class, 'toggleVisibility'])->name('admin.cars.toggleVisibility');
    Route::delete('/admin/cars/{id}', [CarController::class, 'destroy'])->name('admin.cars.delete');
    Route::post('admin/cars/store', [CarController::class, 'store'])->name('admin.cars.store');
    Route::get('admin/cars/{id}/edit', [CarController::class, 'edit'])->name('admin.cars.edit');
    Route::patch('admin/cars/{id}', [CarController::class, 'update'])->name('admin.cars.update');
    Route::delete('admin/cars/gallery/{id}', [CarController::class, 'deleteGalleryImage'])->name('admin.cars.gallery.delete');
    Route::get('admin/InvoiceList', [InvoiceController::class, 'invoiceList'])->name('invoice.list');
   


});


Route::get('/luxury', [CategoryController::class, 'showLuxury'])->name('luxury.page');
Route::get('/premium', [CategoryController::class, 'showPremium'])->name('premium.page');
Route::get('/economy', [CategoryController::class, 'showEconomy'])->name('economy.page');


Route::get('/stripe/payment/{car_id}/{rate_daily}/{days}/{total}/{pickup_date}/{return_date}/{customer_name}/{customer_email}/{customer_phone}/{customer_city}', [StripeController::class, 'pay'])->name('stripe.payment');

Route::get('/payment', function(){
    return view('front.pages.payment');
});

Route::get('/payment/{id}', [PaymentController::class, 'show'])->name('cars.checkout');



Route::post('/stripe/payment', [StripeController::class, 'pay'])->name('stripe.payment');
Route::get('/payment/success', function () {
    return 'Payment was successful!';
})->name('payment.success');
Route::get('/payment/cancel', function () {
    return 'Payment was canceled.';
})->name('payment.cancel');



Route::get('/grant-access/{id}', function ($id) {
    Session::put('allowed_invoice_id', $id);
    return redirect()->route('invoice.show', ['id' => $id]);
})->name('grant-access');

Route::get('/invoice/{id}', [InvoiceController::class, 'show'])
    ->middleware(VerifyInvoiceAccess::class) 
    ->name('invoice.show');

Route::get('/revoke-access', function () {
    Session::forget('allowed_invoice_id');
    return redirect('/');
});


Route::post('/tabby/create-checkout', [TabbyController::class, 'createCheckout'])->name('create.checkout');
Route::get('/payment/success', [TabbyController::class, 'paymentSuccess']);
Route::get('/payment/cancel', [TabbyController::class, 'paymentCancel']);
Route::get('/payment/failure', [TabbyController::class, 'paymentFailure']);
Route::post('/tabby/webhook', [TabbyController::class, 'webhookHandler']);




Route::get('/admin/invoice/{id}', [InvoiceController::class, 'view'])->name('admin.show.invoice');
