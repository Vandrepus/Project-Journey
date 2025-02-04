<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Šis kontrolieris pārvalda administratora paneli, nodrošinot piekļuvi galvenajai administratora informācijas panelim.
 *
 * This controller manages the admin panel, providing access to the main admin dashboard.
 */
class AdminController extends Controller
{
    /**
     * Parāda administratora informācijas paneli.
     *
     * Displays the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.dashboard');
    }
}
