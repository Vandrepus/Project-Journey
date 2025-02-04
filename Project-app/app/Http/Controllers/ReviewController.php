<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Sight; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Šis kontrolieris pārvalda lietotāju atsauksmes par redzēmēm.
 * Lietotāji var pievienot, dzēst un vērtēt redzējumus.
 * 
 * This controller manages user reviews for sights.
 * Users can add, delete, and rate sights.
 */
class ReviewController extends Controller
{
    /**
     * Saglabā jaunu lietotāja atsauksmi par redzējumu.
     *
     * Stores a new user review for a sight.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'sight_id' => 'required|exists:sights,id', // Pārliecinās, ka redzējums pastāv | Ensure the sight exists
            'content'  => 'required|string', // Atsauksmes saturs | Review content
            'rating'   => 'required|integer|min:1|max:5' // Novērtējums 1-5 | Rating between 1 and 5
        ]);

        Review::create([
            'sight_id' => $request->sight_id,
            'user_id'  => Auth::id(), // Pievieno lietotāja ID | Attach user ID
            'content'  => $request->content,
            'rating'   => $request->rating
        ]);

        /**
         * Atjauno redzējuma vidējo novērtējumu
         * Update the sight's average rating
         */
        $this->updateSightAverageRating($request->sight_id);
        return redirect()->back()->with('success', 'Review added successfully');
    }

    /**
     * Dzēš konkrētu atsauksmi un atjauno vidējo novērtējumu.
     *
     * Deletes a specific review and updates the average rating.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $sightId = $review->sight_id; 
        $review->delete();
        /**
         * Atjauno redzējuma vidējo novērtējumu pēc dzēšanas
         * Update the sight's average rating after deletion
         */
        $this->updateSightAverageRating($sightId);

        return redirect()->back()->with('success', 'Review deleted successfully');
    }

    /**
     * Aprēķina un atjauno redzējuma vidējo novērtējumu pēc jaunas atsauksmes pievienošanas vai dzēšanas.
     *
     * Calculates and updates the sight's average rating after adding or deleting a review.
     *
     * @param int $sightId
     */
    protected function updateSightAverageRating($sightId)
    {
        $sight = Sight::findOrFail($sightId);
        $averageRating = $sight->reviews()->avg('rating') ?? 0;
        $sight->update(['average_rating' => $averageRating]);
    }
}
