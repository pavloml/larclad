<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;

class ContactFormController extends Controller
{
    public function store(ContactFormRequest $request)
    {
        $validated = $request->all();

        Mail::to($validated['email'])->send(new ContactFormMail($validated));
        return redirect('/')->with('success', __('Your message has been successfully sent'));
    }
}
