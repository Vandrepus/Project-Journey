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
}
