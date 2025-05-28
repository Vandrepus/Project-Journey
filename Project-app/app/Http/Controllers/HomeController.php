<?php
namespace App\Http\Controllers;

use App\Models\Destination; 
use App\Models\Trip;
use App\Models\Sight;

class HomeController extends Controller
{
    // public function index()
    // {
    //     $destinations = Destination::all(); 
    //     $trips = Trip::all(); 

    //     return view('home', compact('destinations', 'trips')); 
    // }

    public function index()
    {
        $sights = Sight::where('visible', true)->get(); 

        return view('home', [
            'sights' => $sights,
        ]);
    }
}
