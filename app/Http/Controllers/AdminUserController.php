<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\PhoneNumberRule;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $request->validate(['q' => 'string', 'max:140']);

        $sort['column'] = match ($request->get('sortBy')) {
            'username' => 'username',
            'email' => 'email',
            'name' => 'name',
            'created_at' => 'created_at',
            default => 'id',
        };

        $sort['direction'] = match ($request->get('sortDir')) {
            'desc' => 'DESC',
            default => 'ASC'
        };

        return view('admin.user.index',
            ['title' => 'users', 'users' => User::searchByName($request->get('q'))
                ->orderBy($sort['column'], $sort['direction'])
                ->paginate(20)
                ->withQueryString(),
                'sort' => $sort]);
    }

    public function destroy(Request $request, $id)
    {
        if (in_array((int) $id, [1, $request->user()->id])) {
            return back()->with('error', __('You cannot delete a user with id 1 or yourself'));
        }

        $user = User::find($id);

        if (!$user) {
            return back()->with('error', __('User not found'));
        } elseif ($user->role === 'admin') {
            return back()->with('error', __('You cannot delete administrators'));
        }

        $posts = $user->posts()->get();

        foreach ($posts as $post) {
            $post->delete();
        }

        activity('moderation')
            ->causedBy($request->user())
            ->performedOn($user)
            ->log('User deleted');

        $user->delete();

        return back()->with('success', __('User has been successfully deleted'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.user.edit', ['title' => 'Edit a user', 'user' => $user]);
    }

    public function update($id, Request $request)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate(['name' => ['min:3', 'max:70', 'string'],
            'username' => ['alpha_dash', 'min:3', 'max:30', Rule::unique('users', 'username')->ignore($user)],
            'phone' => [new PhoneNumberRule, Rule::unique('users', 'phone')->ignore($user)],
            'email' => ['email:rfc', 'max:255', Rule::unique('users', 'email')->ignore($user)]]);

        $user->update($validated);

        activity('moderation')
            ->event('update')
            ->causedBy($request->user())
            ->performedOn($user)
            ->log('User updated');

        return redirect(route('admin.users'))->with('success', __('User has been successfully updated'));
    }
}
