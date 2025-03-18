<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Šis kontrolieris pārvalda administratora funkcijas attiecībā uz valstīm, tostarp apstiprināšanu, noraidīšanu un rediģēšanu.
 *
 * This controller manages admin functions related to countries, including approval, rejection, and editing.
 */
class AdminCountryController extends Controller
{
    /**
     * Parāda visas ieteiktās valstis, kas vēl nav apstiprinātas.
     *
     * Displays all proposed countries that are not yet approved.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $proposedCountries = Country::proposed()->get();
        return view('admin.countries.index', compact('proposedCountries'));
    }

    /**
     * Apstiprina valsti, padarot to redzamu sistēmā.
     *
     * Approves a country, making it visible in the system.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approve($id)
    {
        $country = Country::findOrFail($id);
        $country->update(['visible' => true]);

        return redirect()->back()->with('success', 'Country approved successfully!');
    }

    /**
     * Noraida valsti un to dzēš no sistēmas.
     *
     * Rejects a country and removes it from the system.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function decline($id)
    {
        $country = Country::findOrFail($id);
        $country->delete();

        return redirect()->back()->with('success', 'Country declined and removed.');
    }

    /**
     * Atver rediģēšanas lapu konkrētai valstij.
     *
     * Opens the edit page for a specific country.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $country = Country::findOrFail($id);
        return view('admin.countries.edit', compact('country'));
    }

    /**
     * Atjaunina valsts informāciju, ieskaitot nosaukumu, aprakstu un attēlu.
     *
     * Updates the country's information, including name, description, and picture.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $country = Country::findOrFail($id);
        $validatedData = $request->validate([
            'name' => 'required|string|max:60|unique:countries,name,' . $country->id,
            'capital' => 'required|string|max:50',
            'description' => 'required|string|max:3000',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        /**
         * Apstrādā attēla augšupielādi, ja tāda ir
         * Handle picture upload if provided
         */
        if ($request->hasFile('picture')) {
            /**
             * Dzēš iepriekšējo attēlu, ja tāds pastāv
             * Delete the previous picture if it exists
             */
            if ($country->picture && Storage::exists('public/' . $country->picture)) {
                Storage::delete('public/' . $country->picture);
            }
            /**
             * Saglabā jauno attēlu
             * Store the new picture
             */
            $path = $request->file('picture')->store('country_photos', 'public');
            $validatedData['picture'] = $path;
        }
        $country->update($validatedData);

        return redirect()->back()->with('success', 'Sight updated successfully!');
    }
}
