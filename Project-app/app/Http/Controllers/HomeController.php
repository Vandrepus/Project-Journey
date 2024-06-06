<?php
namespace App\Http\Controllers;

use App\Models\Destination; // Assuming you have these models
use App\Models\Trip;

class HomeController extends Controller
{
    public function index()
    {
        $destinations = Destination::all(); 
        $trips = Trip::all(); 

        return view('home', compact('destinations', 'trips')); 
    }
}
