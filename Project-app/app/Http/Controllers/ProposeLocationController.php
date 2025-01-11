<?php

// app/Http/Controllers/ProposeLocationController.php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Sight;
use Illuminate\Http\Request;

class ProposeLocationController extends Controller
{
    // Show the form to propose a new sight with a list of approved countries
    public function create()
    {
        // Fetch only approved countries (visible = true)
        $countries = Country::where('visible', true)->get();
        return view('user.location.propose', compact('countries'));
    }

    // Store the proposed sight in the database (invisible until admin approval)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:3000',
            'location' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id', // Ensure valid country ID
            'category' => 'required|string|max:255',
            'opening_hours' => [
                'required',
                'regex:/^((1[0-2]|0?[1-9])\s?(AM|PM)\s?-\s?(1[0-2]|0?[1-9])\s?(AM|PM))$/i',
            ], // Enforce "9 AM - 5 PM" format
            'map_url' => 'nullable|url', // Optional field, must be a valid URL if provided
        ]);

        // Validate if the selected country is approved
        $country = Country::where('id', $request->country_id)->where('visible', true)->first();

        if (!$country) {
            return redirect()->back()->withErrors(['country_id' => 'The selected country is not approved.']);
        }

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
            'submitted_by' => auth()->id(), // Track the user who submitted the sight
        ]);

        return redirect()->route('location.propose')->with('success', 'Sight proposed successfully! Awaiting admin approval.');
    }
}
