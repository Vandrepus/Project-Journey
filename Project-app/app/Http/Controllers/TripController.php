<?php

namespace App\Http\Controllers;

use App\Models\Trip;

/**
 * Varbūt nav izmantots
 * 
 * Probably not in use
 */
class TripController extends Controller
{
    public function index()
    {
    $trips = Trip::all(); 

    
    $trips = $trips->map(function ($trip) {
        $trip->image = asset('storage/' . $trip->image_path);
        return $trip;
    });

    return view('trip', ['trips' => $trips]);
    }
}