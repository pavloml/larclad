<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{

    /**
     * Show the user registration form.
     *
     * @return View
     */
    public function create()
    {
        return view('register.create', ['title' => __('Register')]);
    }

    /**
     * Store a new user.
     *
     * @param RegisterUserRequest $request
     * @return RedirectResponse
     */
    public function store(RegisterUserRequest $request)
    {
        $attributes = $request->safe()->except(['terms', 'g-recaptcha-response']);

        $user = User::create($attributes);
        event(new Registered($user));

        Auth::login($user, true);
        $request->session()->regenerate();
        $authToken = Auth::user()->createToken('authToken');

        $request->session()->put('authToken', $authToken->plainTextToken);
        $request->session()->put('authTokenId', $authToken->accessToken->id);

        return redirect('/')
            ->with('success', __('You have been successfully registered! Check your email box for a verification link'));
    }
}
