<?php

namespace App\Http\Controllers;

use App\Models\Sight;
use App\Models\Review;
use Illuminate\Http\Request;

/**
 * Šis kontrolieris pārvalda redzējumu informācijas attēlošanu un dzēšanu.
 * Lietotāji var apskatīt redzējuma informāciju un pievienotās atsauksmes.
 * Administratori var dzēst redzējumu.
 *
 * This controller manages displaying and deleting sight information.
 * Users can view sight details and reviews, while admins can delete a sight.
 */
class SightController extends Controller
{
    /**
     * Parāda redzējuma informāciju un atsauksmes.
     *
     * Displays sight details along with user reviews.
     *
     * @param Sight $sight
     * @return \Illuminate\View\View
     */
    public function show(Sight $sight)
    {
        $reviews = $sight->reviews()->latest()->get();
        
        return view('user.sights.show', compact('sight', 'reviews'));
    }

    /**
     * Dzēš redzējumu un pārvirza lietotāju atpakaļ uz valsts lapu.
     *
     * Deletes a sight and redirects the user back to the country page.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $sight = Sight::findOrFail($id);

        $sight->delete();

        return redirect()->route('countries.show', $sight->country_id)->with('success', 'Sight deleted successfully.');
    }
}
