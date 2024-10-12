<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FrameOptionsMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Устанавливаем X-Frame-Options
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN'); // Или 'DENY'

        // Устанавливаем Content-Security-Policy с директивой frame-ancestors
        $csp = "default-src 'self'; " .
       "style-src 'self' 'unsafe-inline' https://cdnjs.cloudflare.com http://127.0.0.1:5173;  " .
       "script-src 'self' 'unsafe-inline' https://cdnjs.cloudflare.com https://maxcdn.bootstrapcdn.com http://127.0.0.1:5173 http://[::1]:5173/@vite/client;; " .
       "font-src 'self' https://cdnjs.cloudflare.com; " .
       "img-src 'self' data:; ";


        //$response->headers->set('Content-Security-Policy', $csp);

        return $response;
    }
}
