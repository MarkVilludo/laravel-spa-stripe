<?php

namespace App\Http\Controllers\Api\Mail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PortfolioRequest;
use Mail;
use App\Mail\PortfolioMail;

class PoftfolioEmailController extends Controller
{
    //
    public function sendMail(Request $request)
    {
       // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000',
        ]);

        // If validation passes, proceed to send the email
        $content = [
            'subject' => 'This is the mail subject',
            'body' => 'This is the email body of how to send email from Laravel 10 with Mailtrap.',
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'message' => $validatedData['message'],
        ];

        Mail::to($validatedData['email'])->send(new PortfolioMail($content));

        return "Email has been sent.";
    }
}
