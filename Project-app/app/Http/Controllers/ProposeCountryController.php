<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Šis kontrolieris pārvalda jaunu valstu piedāvāšanas funkcionalitāti.
 * Lietotāji var iesniegt jaunus valstu priekšlikumus, kas būs jāapstiprina administratoram.
 *
 * This controller manages the functionality for proposing new countries.
 * Users can submit new country proposals, which must be approved by an administrator.
 */
class ProposeCountryController extends Controller
{
    /**
     * Parāda valsts priekšlikuma iesniegšanas veidlapu.
     *
     * Displays the form for proposing a new country.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('user.countries.propose');
    }

    /**
     * Apstrādā jaunās valsts priekšlikumu un saglabā to datubāzē.
     *
     * Processes the new country proposal and stores it in the database.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:60|unique:countries,name',
            'capital' => 'required|string|max:50',
            'description' => 'required|string|max:3000',
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        /**
         * Pārbauda, vai attēls ir augšupielādēts
         * Check if the image has been uploaded
         */
        if ($request->hasFile('picture')) {
            $photoPath = $request->file('picture')->store('country_photos', 'public');
        } else {
            return redirect()->back()->withErrors(['picture' => 'The photo file is missing. Please upload a valid file.']);
        }

        /**
         * Izveido jaunu valsts priekšlikumu un saglabā datubāzē
         * Create a new country proposal and save it in the database
         */
        Country::create([
            'name' => $validatedData['name'],
            'capital' => $validatedData['capital'],
            'description' => $validatedData['description'],
            'picture' => $photoPath,
            'submitted_by' => auth()->id(),
            'visible' => false, // Sākotnēji paslēpts (pēc noklusējuma)
        ]);
        return redirect()->back()->with('success', 'Country proposed successfully! Awaiting admin approval.');
    }
}
