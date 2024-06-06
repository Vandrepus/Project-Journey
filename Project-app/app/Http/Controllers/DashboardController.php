<?php
namespace App\Http\Controllers;

use Illuminate\View\View; // Import View class

class DashboardController extends Controller
{
    public function index(): View  // Typehint the return type
    {
        return view('dashboard'); 
    }
}