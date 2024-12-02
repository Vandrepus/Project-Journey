<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class ProposeCountryController extends Controller
{
    public function create()
    {
        return view('user.countries.propose');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:countries,name',
            'description' => 'nullable|string',
        ]);

        Country::create([
            'name' => $request->name,
            'description' => $request->description,
            'submitted_by' => auth()->id(),
            'visible' => false, // Invisible by default
        ]);

        return redirect()->back()->with('success', 'Country proposed successfully! Awaiting admin approval.');
    }
}

