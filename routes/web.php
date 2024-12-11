<?php

// Controllers
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
use App\Http\Controllers\Tabby\TabbyController;
use App\Http\Controllers\Tabby\CheckoutController;

// Services
use App\Services\TabbyService;
use App\Services\AutoTraderService;

// Models
use App\Models\Car;

// Mail
use App\Mail\TestEmail;

// Middleware
use App\Http\Middleware\VerifyInvoiceAccess;
use App\Http\Middleware\SessionAuth;

// Inertia
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Session;

// Public Routes
Route::get('/', [indexController::class, 'showVisibleCars'])->name('index');
Route::get('/home', [indexController::class, 'showVisibleCars'])->name('index');

// Contact & Car Routes
Route::get('/contact-us', [CompanyController::class, 'showContact'])->name('contact');
Route::get('/car/{id}', [CarController::class, 'show'])->name('cars.show');

// Form Routes
Route::post('form/submit', [FormController::class, 'submit'])->name('form.submit');
Route::post('form/contact', [FormController::class, 'sendContactEmail'])->name('form.contact');
Route::get('/submission-status', [FormController::class, 'submissionStatus'])->name('submission.status');

// Newsletter Routes
Route::post('/newsletter', [NewsletterController::class, 'store'])->name('newsletter.store');

// Appointments Routes
Route::get('/appointments/success', [AppointmentsController::class, 'success'])->name('appointments.success');
Route::post('/appointments', [AppointmentsController::class, 'store'])->name('appointments.store');
Route::get('/appointments/create', [AppointmentsController::class, 'create'])->name('appointments.create');

// Static Pages
Route::get('/about', [AboutController::class, 'index'])->name('about');


// Media Routes
Route::get('media/{id}', [MediaController::class, 'show'])->name('media.show');

// Stripe Routes
Route::get('/successview', [StripeController::class, 'successView'])->name('successview');
Route::get('/stripe/payment/{car_id}/{rate_daily}/{days}/{total}/{pickup_date}/{return_date}/{customer_name}/{customer_email}/{customer_phone}/{customer_city}', [StripeController::class, 'pay'])->name('stripe.payment');

// Payment Routes
Route::get('/payment', function() {
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

// Invoice Access Routes
Route::get('/grant-access/{id}', function ($id) {
    Session::put('allowed_invoice_id', $id);
    return redirect()->route('invoice.show', ['id' => $id]);
})->name('grant-access');
Route::get('/invoice/{id}', [InvoiceController::class, 'show'])->middleware(VerifyInvoiceAccess::class)->name('invoice.show');
Route::get('/revoke-access', function () {
    Session::forget('allowed_invoice_id');
    return redirect('/');
});

// Tabby Payment Routes
Route::post('/tabby/create-checkout', [TabbyController::class, 'createCheckout'])->name('create.checkout');
Route::get('/payment/success', [TabbyController::class, 'paymentSuccess']);
Route::get('/payment/cancel', [TabbyController::class, 'paymentCancel']);
Route::get('/payment/failure', [TabbyController::class, 'paymentFailure']);
Route::post('/tabby/webhook', [TabbyController::class, 'webhookHandler']);

// Admin Routes
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

// Category Routes
Route::get('/luxury', [CategoryController::class, 'showLuxury'])->name('luxury.page');
Route::get('/premium', [CategoryController::class, 'showPremium'])->name('premium.page');
Route::get('/economy', [CategoryController::class, 'showEconomy'])->name('economy.page');

// Admin Invoice Routes
Route::get('/admin/invoice/{id}', [InvoiceController::class, 'view'])->name('admin.show.invoice');

// Custom Login Routes
Route::get('admin/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.custom');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
