<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Šis starpprogrammatūras slānis nodrošina, ka tikai administratori var piekļūt noteiktām lapām.
 *
 * This middleware ensures that only administrators can access certain pages.
 */
class AdminMiddleware
{
    /**
     * Pārbauda, vai lietotājs ir autentificēts un vai viņam ir admina piekļuves tiesības.
     * Ja lietotājam nav piekļuves, tiek parādīts 403 kļūdas paziņojums.
     *
     * Checks if the user is authenticated and has admin access rights.
     * If the user does not have access, a 403 error message is displayed.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || auth()->user()->usertype !== 'admin') {
            abort(403, 'Unauthorized'); 
        }
        
        return $next($request);
    }
}
