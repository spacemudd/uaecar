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
use App\Http\Controllers\back\BookingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoryController;

use App\Models\Car;
use App\Services\AutoTraderService;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
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

// Admin Routes
// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return Inertia::render('Dashboard');
//     })->name('dashboard');
    

// });

// Cars Management
// Route::get('/admin/cars', [\App\Http\Controllers\Admin\CarsController::class, 'index'])->name('admin.cars.index');
// Route::get('/admin/cars/{id}', [\App\Http\Controllers\Admin\CarsController::class, 'show'])->name('admin.cars.show');
// Route::post('/admin/cars/{id}/upload', [\App\Http\Controllers\Admin\CarsController::class, 'upload'])->name('admin.cars.upload');


// Route::patch('/admin/cars/{id}/toggle-visibility', [CarController::class, 'toggleVisibility'])->name('admin.cars.toggleVisibility');
// Route::delete('/admin/cars/{id}', [CarController::class, 'destroy'])->name('admin.cars.delete');
// Route::get('/admin/dashboard', [adminDashboardController::class, 'index'])->name('admin.dashboard');
// Route::get('/admin/add-new-car', [adminDashboardController::class, 'addCars'])->name('admin.form');
// Route::get('/admin/carlist', [adminDashboardController::class, 'showCarList'])->name('admin.carlist'); 
// Route::post('admin/cars/store', [CarController::class, 'store'])->name('admin.cars.store');
// Route::get('admin/cars/{id}/edit', [CarController::class, 'edit'])->name('admin.cars.edit');
// Route::patch('admin/cars/{id}', [CarController::class, 'update'])->name('admin.cars.update');
// Route::delete('admin/cars/gallery/{id}', [CarController::class, 'deleteGalleryImage'])->name('admin.cars.gallery.delete');



Route::get('/successview', function () {
    return view('front.pages.successView'); // Adjust to your actual view file
})->name('successview');



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
    Route::get('admin/bookinglist', [BookingController::class, 'bookingList'])->name('booking.list');
    Route::delete('/booking-requests/delete-all', [BookingController::class, 'deleteAll'])->name('booking-requests.deleteAll');
    Route::get('/booking-requests/{id}', [BookingController::class, 'requestProfile'])->name('booking-requests.show');
    Route::patch('/booking-requests/{id}/status', [BookingController::class, 'updateStatus'])->name('bookingRequests.updateStatus');


});


Route::get('/luxury', [CategoryController::class, 'showLuxury'])->name('luxury.page');
Route::get('/premium', [CategoryController::class, 'showPremium'])->name('premium.page');
Route::get('/economy', [CategoryController::class, 'showEconomy'])->name('economy.page');


