<?php

namespace App\Http\Controllers;

use App\Models\Ban;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminBanController extends Controller
{
    public function index(Request $request)
    {
        $sort['column'] = match ($request->get('sortBy')) {
            'user_id' => 'user_id',
            'banned_until' => 'banned_until',
            'created_at' => 'created_at',
            default => 'id',
        };

        $sort['direction'] = match ($request->get('sortDir')) {
            'asc' => 'ASC',
            default => 'DESC'
        };

        return view('admin.ban.index', ['title' => 'bans',
            'bans' => Ban::query()
                ->orderBy($sort['column'], $sort['direction'])
                ->paginate(20)
                ->withQueryString(),
            'sort' => $sort]);
    }

    public function create($user_id)
    {
        $user = User::findOrFail($user_id);
        $activeBan = Ban::where('user_id', $user->id)->active()->first();

        if ($activeBan) {
            return redirect(route('admin.bans.edit', ['id' => $activeBan->id]))
                ->with('warning', __('An active ban for this account was found. You should edit the existing ban instead of creating a new one'));
        }

        return view('admin.ban.create', ['title' => 'Create a ban', 'user' => $user]);
    }

    public function store($user_id, Request $request)
    {
        if ($user_id == $request->user()->id) {
            abort(403, __('You cannot ban yourself'));
        }

        $validated = $request->validate(['banned_until' => ['required', 'date', 'after:today'],
                                        'reason' => ['required', 'string', 'max:160']]);

        $user = User::findOrFail($user_id);
        $ban = new Ban;
        $ban->user_id = $user->id;
        $ban->banned_until = Carbon::create($validated['banned_until']);
        $ban->reason = $validated['reason'];
        $ban->save();

        return redirect(route('admin.bans'))->with('success', __('The user has been successfully banned'));

    }

    public function edit($id)
    {
        $ban = Ban::findOrFail($id);
        $user = User::find($ban->user_id);

        return view('admin.ban.edit', ['title' => 'Edit a ban', 'user' => $user, 'ban' => $ban]);
    }

    public function update($id, Request $request)
    {
        $ban = Ban::findOrFail($id);
        $validated = $request->validate(['banned_until' => ['required', 'date', 'after:today'],
            'reason' => ['required', 'string', 'max:160']]);

        $ban->banned_until = Carbon::create($validated['banned_until']);
        $ban->reason = $validated['reason'];
        $ban->save();
        return redirect(route('admin.bans'))->with('success', __('The ban has been successfully updated'));


    }

    public function destroy($id)
    {
        $ban = Ban::findOrFail($id);
        $ban->delete();

        return back()->with('success', __('The ban has been successfully deleted'));
    }
}
