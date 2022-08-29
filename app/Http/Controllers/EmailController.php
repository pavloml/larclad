<?php

namespace App\Http\Controllers;

use App\Events\EmailUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class EmailController extends Controller
{
    public function edit(Request $request)
    {
        return view('profile.change-email', ['title' => __('Change email'), 'user' => $request->user()]);
    }

    public function update(Request $request)
    {
        $user = $request->user();

        if (!Hash::check($request->post('current-password') ?? '', $user->password)) {
            return back()->withErrors(['password' => __('The current password is incorrect')]);
        }
        $validated = $request->validate(['email' =>
            ['email:rfc', 'max:255', Rule::unique('users', 'email')->ignore($user)]]);


        event(new EmailUpdated($user));

        $user->email = $validated['email'];
        $user->save();

        return back()->with('success', __('Your email has been successfully updated'));
    }
}
