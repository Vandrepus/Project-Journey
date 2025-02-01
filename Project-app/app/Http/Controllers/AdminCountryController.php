<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class AdminCountryController extends Controller
{
    public function index()
    {
        $proposedCountries = Country::proposed()->get();
        return view('admin.countries.index', compact('proposedCountries'));
    }

    public function approve($id)
    {
        $country = Country::findOrFail($id);
        $country->update(['visible' => true]);

        return redirect()->back()->with('success', 'Country approved successfully!');
    }

    public function decline($id)
    {
        $country = Country::findOrFail($id);
        $country->delete();

        return redirect()->back()->with('success', 'Country declined and removed.');
    }

    public function edit($id)
    {
        $country = Country::findOrFail($id);

        return view('admin.countries.edit', compact('country'));
    }

    public function update(Request $request, $id)
    {
        $country = Country::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:60|unique:countries,name,' . $country->id,
            'capital' => 'required|string|max:50',
            'description' => 'required|string|max:3000',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle photo upload if provided
        if ($request->hasFile('picture')) {
            if ($country->photo && Storage::exists('public/' . $country->picture)) {
                Storage::delete('public/' . $country->photo);
            }

            $path = $request->file('picture')->store('country_photos', 'public');
            $validatedData['picture'] = $path;
        }

        $country->update($validatedData);

        return redirect()->route('countries.index')->with('success', 'Country updated successfully.');
    }
}
