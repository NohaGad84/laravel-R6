<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Mail\OrderShipped;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function contactForm() {
        return view('contact_us');
    }

    public function sendEmail(Request $request) {
        $data = $request->except('_token');

        Mail::to('test@example.com')->send(new OrderShipped($data));

        return "Message sent successfuly";
    }  
}
