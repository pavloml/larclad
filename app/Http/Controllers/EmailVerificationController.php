<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    public function notify()
    {
        return redirect(@route('profile.posts.active'))->with('email-verification-warning', __('You have to verify your email. Check your email box for a verification link'));
    }

    public function store(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect(@route('home'))->with('success', __('Your email has been successfully verified'));
    }

    public function create(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return redirect(@route('home'))->with('success', __('Verification link sent!'));
    }
}
