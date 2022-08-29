<?php

namespace App\Http\Middleware;

use App\Models\Ban;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CheckIfBanned
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guest()){
            return redirect('login');
        }

        $ban = Ban::where('user_id', Auth::id())->active()->first();

        if ($ban) {
            if ($request->route()->getPrefix() === 'api') {
                return response(['message' => __('You are banned until') . ' ' . $ban->banned_until], 403);
            }
            return redirect('/')->with('error', __('You are banned until') . ' ' . $ban->banned_until);
        }

        return $next($request);
    }
}
