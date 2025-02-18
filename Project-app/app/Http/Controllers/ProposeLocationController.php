<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Sight;
use Illuminate\Http\Request;

/**
 * Šis kontrolieris pārvalda jaunu apskates vietu priekšlikumus, ko iesniedz lietotāji.
 * Apskates vietas tiek saglabātas kā "neredzamas", līdz administrators tās apstiprina.
 *
 * This controller manages the user-submitted proposals for new sights.
 * Sights are stored as "invisible" until an administrator approves them.
 */
class ProposeLocationController extends Controller
{
    /**
     * Parāda veidlapu, lai piedāvātu jaunu apskates vietu, iekļaujot apstiprināto valstu sarakstu.
     *
     * Displays the form to propose a new sight, including a list of approved countries.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        /**
         * Iegūst tikai apstiprinātās valstis (visible = true)
         * Fetch only approved countries (visible = true)
         */
        $countries = Country::where('visible', true)->get();
        
        return view('user.location.propose', compact('countries'));
    }

    /**
     * Saglabā piedāvāto apskates vietu datubāzē (sākotnēji "neredzama").
     *
     * Stores the proposed sight in the database (initially "invisible").
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'           => 'required|string|max:255',
            'description'    => 'required|string|max:3000',
            'location'       => 'required|string|max:255',
            'country_id'     => 'required|exists:countries,id',
            'category'       => 'required|string|max:255',
            'opening_hours'  => [
                'required',
                'regex:/^(24\\/7|(?:0?[1-9]|1[0-2])(?:\\:[0-5]\\d)?\\s?(?:AM|PM)\\s?-\\s?(?:0?[1-9]|1[0-2])(?:\\:[0-5]\\d)?\\s?(?:AM|PM))$/i',
            ],
            'map_url'        => 'nullable|url',
            'photo'          => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        /**
         * Pārbauda, vai izvēlētā valsts ir apstiprināta
         * Validate if the selected country is approved
         */
        $country = Country::where('id', $validatedData['country_id'])
            ->where('visible', true)
            ->first();

        if (!$country) {
            return redirect()->back()->withErrors([
                'country_id' => 'The selected country is not approved.'
            ]);
        }
        /**
         * Apstrādā fotoattēla augšupielādi, ja fails ir nodrošināts
         * Handle the photo upload if a file is provided
         */ 
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('sight_photos', 'public');
        }

        Sight::create([
            'name'           => $validatedData['name'],
            'description'    => $validatedData['description'],
            'location'       => $validatedData['location'],
            'country_id'     => $validatedData['country_id'],
            'category'       => $validatedData['category'],
            'opening_hours'  => $validatedData['opening_hours'],
            'map_url'        => $validatedData['map_url'] ?? null,
            'photo'          => $photoPath, 
            'visible'        => 0, 
            'submitted_by'   => auth()->id(), 
        ]);

        return redirect()->route('location.propose')->with('success', 'Sight proposed successfully! Awaiting admin approval.');
    }
}
