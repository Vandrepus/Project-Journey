<?php

// app/Http/Controllers/ProposeLocationController.php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Sight;
use Illuminate\Http\Request;

class ProposeLocationController extends Controller
{
    // Show the form to propose a new sight with a list of countries
    public function create()
    {
        // Fetch all available countries
        $countries = Country::all();
        return view('user.location.propose', compact('countries'));
    }

    // Store the proposed sight in the database (invisible until admin approval)
    public function store(Request $request)
    {
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'location' => 'required|string',
        'country_id' => 'required|exists:countries,id', // Make sure country is selected
        'category' => 'required|string|max:255',
        'opening_hours' => 'required|string',
        'map_url' => 'nullable|url', // Optional field, must be a valid URL if provided
    ]);

    // Store the proposed sight as invisible by default
    Sight::create([
        'name' => $request->name,
        'description' => $request->description,
        'location' => $request->location,
        'country_id' => $request->country_id,
        'category' => $request->category,
        'opening_hours' => $request->opening_hours,
        'map_url' => $request->map_url,
        'visible' => 0, // Invisible by default
        'submitted_by' => auth()->id()
    ]);

    return redirect()->back()->with('success', 'Sight proposed successfully! Awaiting admin approval.');
    }
}
