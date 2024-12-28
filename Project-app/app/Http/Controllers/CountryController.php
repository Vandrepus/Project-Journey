<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::where('visible', true)->get();
        return view('user.countries.index', compact('countries'));
    }

    public function show(Country $country)
    {
        // Retrieve only the sights that are visible
        $sights = $country->sights()->where('visible', 1)->get();

        return view('user.countries.show', compact('country', 'sights'));
    }

    public function destroy($id)
    {
        $country = Country::findOrFail($id);
        $country->delete();

        return redirect()->route('countries.index')->with('success', 'Country deleted successfully.');
    }

}
