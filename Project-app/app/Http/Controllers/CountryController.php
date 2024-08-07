<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        return view('user.countries.index', compact('countries'));
    }

    public function show(Country $country)
    {
        $sights = $country->sights; // Assuming a Country has many Sights
        return view('user.countries.show', compact('country', 'sights'));
    }

    

    
}