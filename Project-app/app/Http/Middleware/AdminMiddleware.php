<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || auth()->user()->usertype !== 'admin') {
            abort(403, 'Unauthorized'); // Or redirect to another page
        }

        return $next($request);
    }
}
