<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{StripePaymentController, SubscriptionController};
use App\Http\Controllers\Api\PostController;
use Inertia\Inertia; // Import the Inertia facade
use Illuminate\Foundation\Application;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/payment', [StripePaymentController::class, 'showPaymentForm']);
Route::post('/payment', [StripePaymentController::class, 'processPayment']);
Route::get('/payment/success', [StripePaymentController::class, 'paymentSuccess'])->name('payment.success');

// Routes with 'auth' middleware
Route::middleware(['auth:sanctum'])->group(function () {
    //subscription
    // Route::get('/subscribe', [SubscriptionController::class, 'showSubscription']);
    Route::post('/subscribe', [SubscriptionController::class, 'processSubscription'])->name('subscribe.post');
});

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/subscribe', [SubscriptionController::class, 'showSubscription'])->name('subscription');
    Route::resource('/posts', PostController::class);
});