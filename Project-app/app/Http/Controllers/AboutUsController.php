<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Šis kontrolieris pārvalda "Par Mums" lapas skatījumu.
 * 
 * This controller manages the "About Us" page view.
 */
class AboutUsController extends Controller
{
    /**
     * Parāda "Par Mums" lapu.
     *
     * Displays the "About Us" page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('about'); 
    }
}
