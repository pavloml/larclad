<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthToken
{
    /**
     * Checks if bearer token is present in session and generates a new one if not
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guest()) {
            if (!session('authToken')) {
                $authToken = Auth::user()->createToken('authToken');
                $request->session()->put('authToken', $authToken->plainTextToken);
                $request->session()->put('authTokenId', $authToken->accessToken->id);
            }
        }

        return $next($request);
    }
}
