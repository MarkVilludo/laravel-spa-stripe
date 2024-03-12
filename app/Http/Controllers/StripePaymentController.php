<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Stripe;

class StripePaymentController extends Controller
{
    //
    public function showPaymentForm()
    {
        return view('payment.form');
    }

    public function processPayment(Request $request)
    {  
        // dd($request->all());
        Stripe::setApiKey(config('services.stripe.secret'));
        $token = $request->input('stripeToken');

        try {
            Charge::create([
                'amount' => 1000, // amount in cents
                'currency' => 'usd',
                'description' => 'Example Charge',
                'source' => $token,
            ]);

            return redirect()->route('payment.success');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function paymentSuccess()
    {
        return view('payment.success');
    }
}
