<?php

namespace App\Http\Controllers;

use App\Events\ProfileUpdated;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function edit(Request $request)
    {
        return view('profile.settings', ['user' => $request->user(), 'title' => __('Edit profile')]);
    }

    public function update(UpdateUserRequest $request)
    {
        $user = $request->user();
        $attributes = $request->validated();

        if (empty($attributes)) {
            return back();
        }

        $user->update($attributes);

        event(new ProfileUpdated($user));

        return back()->with('success', __('Your profile has been successfully updated'));
    }

    public function showActivePosts(Request $request)
    {
        return view('profile.posts', ['posts' =>
            Post::with(['user', 'images', 'subcategory.category', 'city'])
                ->belongsToUser($request->user()->id)
                ->active()
                ->orderBy('updated_at', 'DESC')
                ->paginate(12)
                ->withQueryString(),
            'title' => __('Active ads')]);
    }

    public function showInactivePosts(Request $request)
    {
        return view('profile.posts', ['posts' =>
            Post::with(['user', 'images', 'subcategory.category', 'city'])
                ->belongsToUser($request->user()->id)
                ->active(false)
                ->orderBy('updated_at', 'DESC')
                ->paginate(10)
                ->withQueryString(),
            'title' => __('Inactive ads')]);
    }

}
