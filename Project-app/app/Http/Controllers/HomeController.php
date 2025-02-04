<?php
namespace App\Http\Controllers;
/**
 * Varbūt nav izmantots
 * 
 * Probably not in use
 */
use App\Models\Destination; 
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
