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

    public function show(Country $country, Request $request)
    {
        // Retrieve the rating filter value from the request
        $rating = $request->get('rating', null);

        // Retrieve sights based on the rating filter
        $sights = $country->sights()
            ->where('visible', 1)
            ->when($rating, function ($query, $rating) {
                return $query->where('average_rating', '>=', $rating);
            })
            ->get();

        return view('user.countries.show', compact('country', 'sights', 'rating'));
    }

    public function destroy($id)
    {
        $country = Country::findOrFail($id);
        $country->delete();

        return redirect()->route('countries.index')->with('success', 'Country deleted successfully.');
    }

}
