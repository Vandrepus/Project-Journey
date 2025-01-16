<?php

namespace App\Http\Controllers;

use App\Models\Sight;
use App\Models\Country;
use Illuminate\Http\Request;

class ReviewSightsController extends Controller
{
    public function index()
    {
        $pendingSights = Sight::where('visible', 0)->get();
        return view('admin.sights.index', compact('pendingSights'));
    }

    public function show($id)
    {
        $sight = Sight::findOrFail($id);
        return view('admin.sights.show', compact('sight'));
    }

    public function approve($id)
    {
        $sight = Sight::findOrFail($id);
        $sight->update(['visible' => 1]); // Make sight visible
        return redirect()->back()->with('success', 'Sight approved successfully!');
    }

    public function decline($id)
    {
        $sight = Sight::findOrFail($id);
        $sight->delete(); // Delete the sight from the database

        // Redirect to the review page with a success message
        return redirect()->route('admin.sights.index')->with('success', 'Sight declined and removed from the database.');
    }

    public function edit($id)
    {
        $sight = Sight::findOrFail($id);
        $countries = Country::all();

        return view('admin.sights.edit', compact('sight', 'countries'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'location' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'opening_hours' => [
                'required',
                'regex:/^((1[0-2]|0?[1-9])\s?(AM|PM)\s?-\s?(1[0-2]|0?[1-9])\s?(AM|PM))$/i'
            ],
            'map_url' => 'nullable|url',
            'description' => 'nullable|string',
        ]);

        // Find the sight and update it
        $sight = Sight::findOrFail($id);
        $sight->update($validatedData);

        return redirect()->back()->with('success', 'Sight updated successfully!');
    }
}
