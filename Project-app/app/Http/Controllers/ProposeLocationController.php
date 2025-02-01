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
        // Validate incoming request data, including a single photo upload
        $validatedData = $request->validate([
            'name'           => 'required|string|max:255',
            'description'    => 'required|string|max:3000',
            'location'       => 'required|string|max:255',
            'country_id'     => 'required|exists:countries,id',
            'category'       => 'required|string|max:255',
            'opening_hours'  => [
                'required',
                'regex:/^((1[0-2]|0?[1-9])\s?(AM|PM)\s?-\s?(1[0-2]|0?[1-9])\s?(AM|PM))$/i',
            ],
            'map_url'        => 'nullable|url',
            'photo'          => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Validate if the selected country is approved
        $country = Country::where('id', $validatedData['country_id'])
            ->where('visible', true)
            ->first();

        if (!$country) {
            return redirect()->back()->withErrors([
                'country_id' => 'The selected country is not approved.'
            ]);
        }

        // Handle the photo upload if a file is provided
        $photoPath = null;
        if ($request->hasFile('photo')) {
            // Store the photo in storage/app/public/sight_photos
            $photoPath = $request->file('photo')->store('sight_photos', 'public');
        }

        // Store the proposed sight as invisible by default
        Sight::create([
            'name'           => $validatedData['name'],
            'description'    => $validatedData['description'],
            'location'       => $validatedData['location'],
            'country_id'     => $validatedData['country_id'],
            'category'       => $validatedData['category'],
            'opening_hours'  => $validatedData['opening_hours'],
            'map_url'        => $validatedData['map_url'] ?? null,
            'photo'          => $photoPath, // Save the single photo path or null if not provided
            'visible'        => 0, // Invisible by default
            'submitted_by'   => auth()->id(), // Track the user who submitted the sight
        ]);

        return redirect()->route('location.propose')->with('success', 'Sight proposed successfully! Awaiting admin approval.');
    }
}
