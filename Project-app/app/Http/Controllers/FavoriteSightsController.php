<?php

namespace App\Http\Controllers;

use App\Models\Sight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Šis kontrolieris pārvalda lietotāja iecienītās apskates vietas.
 * Lietotāji var pievienot, skatīt un noņemt apskates vietas no favorītiem.
 *
 * This controller manages the user's favorite sights.
 * Users can add, view, and remove sights from their favorites.
 */
class FavoriteSightsController extends Controller
{
    /**
     * Parāda lietotāja iecienīto apskates vietu sarakstu.
     *
     * Displays the list of favorite sights for the authenticated user.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        /**
         * Iegūst lietotāja iecienītās apskates vietas
         * Retrieve favorite sights for the authenticated user
         */
        $favorites = Auth::user()->favoriteSights()->get();
        
        return view('user.favorites.index', compact('favorites'));
    }

    /**
     * Pievieno apskates vietu lietotāja favorītiem.
     * Neļauj dublēt ierakstus.
     *
     * Adds a sight to the user's favorites.
     * Prevents duplicate entries.
     *
     * @param Sight $sight
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Sight $sight)
    {
        /**
         * Pievieno apskates vietu favorītiem bez dublēšanas
         * Add the sight to the user's favorites without duplicating
         */
        Auth::user()->favoriteSights()->syncWithoutDetaching($sight->id);
        
        return redirect()->back()->with('success', 'Sight added to favorites!');
    }

    /**
     * Noņem apskates vietu no lietotāja favorītiem.
     *
     * Removes a sight from the user's favorites.
     *
     * @param Sight $sight
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Sight $sight)
    {
        Auth::user()->favoriteSights()->detach($sight->id);
        
        return redirect()->back()->with('success', 'Sight removed from favorites!');
    }
}
