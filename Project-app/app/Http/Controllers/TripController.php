<?php

namespace App\Http\Controllers;

use App\Models\Trip;

class TripController extends Controller
{
    public function index()
    {
    $trips = Trip::all(); // Fetch trips from your database (adjust as needed)

    // Transform trip data if necessary (add image paths, etc.)
    $trips = $trips->map(function ($trip) {
        $trip->image = asset('storage/' . $trip->image_path);
        return $trip;
    });

    return view('trip', ['trips' => $trips]);
    }
}