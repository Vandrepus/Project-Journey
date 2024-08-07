<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Sight; // Import the Sight model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'sight_id' => 'required|exists:sights,id',
            'content' => 'required',
            'rating' => 'required|integer|min:1|max:5'
        ]);

        // Create a new review
        Review::create([
            'sight_id' => $request->sight_id,
            'user_id' => Auth::id(),
            'content' => $request->content,
            'rating' => $request->rating
        ]);

        // Update the sight's average rating
        $this->updateSightAverageRating($request->sight_id);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Review added successfully');
    }

    public function destroy($id)
    {
        // Find and delete the review
        $review = Review::findOrFail($id);
        $sightId = $review->sight_id;
        $review->delete();

        // Update the sight's average rating
        $this->updateSightAverageRating($sightId);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Review deleted successfully');
    }

    private function updateSightAverageRating($sightId)
    {
        $sight = Sight::findOrFail($sightId);
        $averageRating = $sight->reviews()->avg('rating');
        $sight->update(['average_rating' => $averageRating]);
    }
}
