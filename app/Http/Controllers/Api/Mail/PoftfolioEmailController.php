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
    public function sendMail()
    {
        $content = [
            'subject' => 'This is the mail subject',
            'body' => 'This is the email body of how to send email from laravel 10 with mailtrap.',
            'name' => request('name'),
            'email' => request('email'),
            'message' => request('message'),
        ];

        Mail::to('villludomark@gmail.com')->send(new PortfolioMail($content));

        return "Email has been sent.";
    }
}
