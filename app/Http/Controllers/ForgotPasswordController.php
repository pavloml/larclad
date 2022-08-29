<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function create()
    {
        return view('forgot_password.create', ['title' => 'Forgot password?']);
    }

    public function store(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? redirect('/')->with('success', __($status))
            : back()->withErrors(['email' => __($status)]);
    }
}
