<?php

namespace App\Http\Controllers;

use Illuminate\View\View; 

/**
 * Šis kontrolieris pārvalda administratora vai lietotāja paneļa attēlošanu.
 *
 * This controller manages the display of the dashboard for the admin or user.
 */
class DashboardController extends Controller
{
    /**
     * Parāda informācijas paneli (Dashboard) lietotājam.
     *
     * Displays the dashboard for the user.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View 
    {
        return view('dashboard'); 
    }
}
