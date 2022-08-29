<?php

namespace App\Http\Controllers;

use App\Events\PasswordUpdated;
use App\Rules\PasswordRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function edit()
    {
        return view('profile.change-password', ['title' => __('Change password')]);
    }

    public function update(Request $request)
    {
        $user = $request->user();

        if (!Hash::check($request->post('current-password') ?? '', $user->password)) {
            return back()->withErrors(['current-password' => __('The current password is incorrect')]);
        }

        $password = $request->validate(['password' =>  ['required', 'min:8', 'max:75', 'confirmed', new PasswordRule]]);

        $user->password = $password['password'];
        $user->save();

        Auth::logoutOtherDevices($password['password']);
        event(new PasswordUpdated($user));

        return back()->with('success', __('Your password has been successfully updated'));
    }
}
