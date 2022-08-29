<?php

namespace App\Http\Controllers;


use App\Events\PasswordUpdated;
use App\Rules\PasswordRule;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function create(Request $request)
    {
        return view('reset_password.create',
            ['title' => 'Reset password',
                'email' => $request->get('email') ?? '',
                'token' => $request->get('token') ?? '']);
    }

    public function store(Request $request)
    {

        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'min:8', 'max:75', 'confirmed', new PasswordRule]]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) use ($request) {
                $user->forceFill([
                    'password' => $password
                ])->setRememberToken(Str::random(60));

                $user->save();
                Auth::logoutOtherDevices($password);

                event(new PasswordUpdated($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('success', __($status));
        } else {
            return back()->withErrors(['email' => [__($status)]]);
        }
    }
}
