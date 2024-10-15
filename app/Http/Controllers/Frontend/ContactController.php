<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ContactEmail;
use App\Models\Contact\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Artesaos\SEOTools\Facades\SEOMeta;


class ContactController extends Controller
{

    public function index()
    {
        SEOMeta::setTitle('Contact');
        return view('frontend.contact.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $getEmail = env('MAIL_FROM_ADDRESS');

        $details = $request->all();
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->message = $request->message;
        $contact->save();
        Mail::to($getEmail)->send(new ContactEmail($details));

        return redirect()->back()->with('success', 'Your message has been sent successfully.');
    }
}
