<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

/**
 * Šis kontrolieris pārvalda valstu skatīšanu, dzēšanu un redzamo datu filtrēšanu.
 *
 * This controller manages country viewing, deletion, and filtering of visible data.
 */
class CountryController extends Controller
{
    /**
     * Parāda visas redzamās valstis lietotāju skatā.
     *
     * Displays all visible countries in the user view.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        /**
         * Atlasa visas valstis, kas ir redzamas (apstiprinātas admina)
         * Selects all countries that are visible (approved by admin)
         */
        
         $query = Country::query()->where('visible', true);

         if ($request->filled('search')) {
             $search = $request->input('search');
             $query->where(function ($q) use ($search) {
                 $q->where('name', 'like', "%{$search}%")
                   ->orWhere('capital', 'like', "%{$search}%")
                   ->orWhere('description', 'like', "%{$search}%");
             });
         }
     
         $countries = $query->get();
     
         return view('user.countries.index', compact('countries'));
    }

    /**
     * Parāda konkrētās valsts informāciju un tās apskates vietas.
     *
     * Displays a specific country and its sights.
     *
     * @param \App\Models\Country $country
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function show(Country $country, Request $request)
    {
        /**
         * Iegūst lietotāja izvēlēto reitinga filtru (ja tāds ir)
         * Retrieve the rating filter from the request (if provided)
         */
        $rating = $request->get('rating', null);
        /**
         * Atlasa visas redzamās apskates vietas valstī, kas atbilst reitinga kritērijam
         * Retrieve visible sights in the country that match the rating filter
         */
        $sights = $country->sights()
            ->where('visible', 1)
            ->when($rating, function ($query, $rating) {
                return $query->where('average_rating', '>=', $rating);
            })
            ->get();

        return view('user.countries.show', compact('country', 'sights', 'rating'));
    }

    /**
     * Dzēš norādīto valsti, ja tā pastāv.
     *
     * Deletes the specified country if it exists.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $country = Country::findOrFail($id);
        $country->delete();
        return redirect()->route('countries.index')->with('success', 'Country deleted successfully.');
    }
}
