<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProposeCountryController extends Controller
{
    public function create()
    {
        return view('user.countries.propose');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:60|unique:countries,name',
            'capital' => 'required|string|max:50',
            'description' => 'required|string|max:3000',
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('picture')) {
            $photoPath = $request->file('picture')->store('country_photos', 'public');
        } else {
            return redirect()->back()->withErrors(['picture' => 'The photo file is missing. Please upload a valid file.']);
        }

        Country::create([
            'name' => $validatedData['name'],
            'capital' => $validatedData['capital'],
            'description' => $validatedData['description'],
            'picture' => $photoPath,
            'submitted_by' => auth()->id(),
            'visible' => false, // Invisible by default
        ]);

        return redirect()->back()->with('success', 'Country proposed successfully! Awaiting admin approval.');
    }

}
