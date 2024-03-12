<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{StripePaymentController, SubscriptionController};

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
//subscription
Route::get('subscribe', [SubscriptionController::class, 'showSubscription']);
Route::post('subscribe', [SubscriptionController::class, 'processSubscription'])->name('subscribe.post');

