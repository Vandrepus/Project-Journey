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
            'name' => 'required|string|max:60|unique:countries,name',
            'capital' => 'required|string|max:50',
            'description' => 'required|string|max:3000',
        ], [
            'name.unique' => 'The country name has already been proposed. Please propose a different country.',
        ]);

        Country::create([
            'name' => $request->name,
            'capital' => $request->capital,
            'description' => $request->description,
            'submitted_by' => auth()->id(),
            'visible' => false, // Invisible by default
        ]);

        return redirect()->back()->with('success', 'Country proposed successfully! Awaiting admin approval.');
    }

}

