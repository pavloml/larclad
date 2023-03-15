<?php

namespace App\Http\Controllers;

use App\Events\FailedLogin;
use App\Events\SuccessfulLogin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{

    public function create()
    {
        return view('sessions.create', ['title' => 'Log in']);
    }

    public function destroy(Request $request)
    {
        if (session('authTokenId')) {
            Auth::user()->tokens()->where('id', session('authTokenId'))->delete();
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate(
            ['email' => ['required', 'email:rfc'],
                'password' => ['required', 'max:75']]);

        if (RateLimiter::tooManyAttempts($request->ip() . $attributes['email'], 5)) {
            $secondsToUnlock = RateLimiter::availableIn($request->ip() . $attributes['email']);
            throw ValidationException::withMessages(['email' => __("Too many attempts try again in $secondsToUnlock seconds")]);
        }

        if (Auth::attempt($attributes, (bool) $request->post('remember') ?? false)){
            $user = Auth::user();

            RateLimiter::clear($request->ip() . $attributes['email']);

            event(new SuccessfulLogin($user));

            $request->session()->regenerate();
            $authToken = $user->createToken('authToken');

            $request->session()->put('authToken', $authToken->plainTextToken);
            $request->session()->put('authTokenId', $authToken->accessToken->id);

            return redirect(route('profile'));
        }

        $user = User::where('email', $attributes['email'])->first();
        if($user) {
            event(new FailedLogin($user));
        }

        RateLimiter::hit($request->ip() . $attributes['email'], 120);
        throw ValidationException::withMessages(['email' => __('Invalid credentials')]);

    }
}
