<?php

namespace App\Http\Controllers;

use App\Models\Sight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import the Auth facade

class FavoriteSightsController extends Controller
{
    public function index()
    {
        // Retrieve favorite sights for the authenticated user
        $favorites = Auth::user()->favoriteSights()->get();
        return view('user.favorites.index', compact('favorites'));
    }

    public function store(Sight $sight)
    {
        // Add the sight to the user's favorites without duplicating
        Auth::user()->favoriteSights()->syncWithoutDetaching($sight->id);
        return redirect()->back()->with('success', 'Sight added to favorites!');
    }

    public function destroy(Sight $sight)
    {
        // Remove the sight from the user's favorites
        Auth::user()->favoriteSights()->detach($sight->id);
        return redirect()->back()->with('success', 'Sight removed from favorites!');
    }
}
