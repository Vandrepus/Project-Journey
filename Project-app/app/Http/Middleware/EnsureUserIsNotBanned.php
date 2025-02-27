<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsNotBanned
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and banned
        if (Auth::check() && Auth::user()->banned) {
            $banReason = Auth::user()->ban_reason;
            Auth::logout();

            $errorMessage = "Your account has been banned.";
            $errorMessage .= "Reason: " . ($banReason ? $banReason : 'No reason') . "\n";
            $errorMessage .= "Please contact support.";

            return redirect()->route('login')->withErrors([$errorMessage]);
        }
        return $next($request);
    }
}
