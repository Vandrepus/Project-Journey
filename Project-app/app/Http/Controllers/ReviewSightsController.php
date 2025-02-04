<?php

namespace App\Http\Controllers;

use App\Models\Sight;
use App\Models\Country;
use Illuminate\Http\Request;

/**
 * Šis kontrolieris pārvalda redzējumu pārskatīšanu un apstiprināšanu administrācijas panelī.
 * Administratori var apskatīt, apstiprināt, rediģēt un dzēst redzējumus.
 *
 * This controller handles the review and approval of sights in the admin panel.
 * Admins can view, approve, edit, and delete sights.
 */
class ReviewSightsController extends Controller
{
    /**
     * Parāda visus redzējumus, kas gaida apstiprinājumu.
     *
     * Displays all pending sights waiting for approval.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $pendingSights = Sight::where('visible', 0)->get();
        return view('admin.sights.index', compact('pendingSights'));
    }

    /**
     * Parāda konkrēta redzējuma informāciju.
     *
     * Displays details of a specific sight.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $sight = Sight::findOrFail($id);
        return view('admin.sights.show', compact('sight'));
    }

    /**
     * Apstiprina redzējumu un padara to redzamu lietotājiem.
     *
     * Approves the sight and makes it visible to users.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approve($id)
    {
        $sight = Sight::findOrFail($id);
        $sight->update(['visible' => 1]);

        return redirect()->route('admin.sights.index')->with('success', 'Sight approved successfully!');
    }

    /**
     * Noraida un dzēš redzējumu no datubāzes.
     *
     * Declines and deletes the sight from the database.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function decline($id)
    {
        $sight = Sight::findOrFail($id);
        $sight->delete(); 

        return redirect()->route('admin.sights.index')->with('success', 'Sight declined and removed from the database.');
    }

    /**
     * Parāda redzējuma rediģēšanas formu.
     *
     * Displays the edit form for a sight.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $sight = Sight::findOrFail($id);
        $countries = Country::all();

        return view('admin.sights.edit', compact('sight', 'countries'));
    }

    /**
     * Atjaunina redzējuma informāciju, ieskaitot valsti, aprakstu un attēlu.
     *
     * Updates the sight's information, including country, description, and image.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'location' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'opening_hours' => [
                'required',
                'regex:/^((1[0-2]|0?[1-9])\s?(AM|PM)\s?-\s?(1[0-2]|0?[1-9])\s?(AM|PM))$/i'
            ],
            'map_url' => 'nullable|url',
            'description' => 'required|string|max:3000',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $sight = Sight::findOrFail($id);
        /**
         * Apstrādā attēla augšupielādi tikai tad, ja ir augšupielādēts jauns attēls
         * Handle image upload only if a new file is uploaded
         */
        if ($request->hasFile('photo')) {
            /**
             * Dzēš iepriekšējo attēlu, ja tas pastāv
             * Delete the old image if it exists
             */
            if ($sight->photo && file_exists(storage_path('app/public/' . $sight->photo))) {
                unlink(storage_path('app/public/' . $sight->photo));
            }
            $photoPath = $request->file('photo')->store('sight_photos', 'public');
            $validatedData['photo'] = $photoPath;
        } else {
            /**
             * Neatjauno attēlu, ja jauns attēls nav augšupielādēts
             * Do not overwrite the photo if no new image is uploaded
             */
            unset($validatedData['photo']);
        }
        $sight->update($validatedData);

        return redirect()->back()->with('success', 'Sight updated successfully!');
    }
}
