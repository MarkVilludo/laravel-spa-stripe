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
    public function sendMail(PortfolioRequest $request)
    {
        $content = [
            'subject' => 'Message from Portfolio',
            'body' => 'This is the email body of how to send email from Laravel 10 with Mailtrap.',
            'name' => request('name'),
            'email' => request('email'),
            'message' => request('message'),
        ];
        Mail::to(request('email'))->send(new PortfolioMail($content));
        return "Email has been sent.";
    }
}
