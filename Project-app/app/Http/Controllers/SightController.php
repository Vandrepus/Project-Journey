<?php

// app/Http/Controllers/SightController.php

namespace App\Http\Controllers;

use App\Models\Sight;
use App\Models\Review;
use Illuminate\Http\Request;

class SightController extends Controller
{
    public function show(Sight $sight)
    {
        $reviews = $sight->reviews()->latest()->get();
        return view('user.sights.show', compact('sight', 'reviews'));
    }

    public function destroy($id)
    {
        // Find the sight by ID or fail
        $sight = Sight::findOrFail($id);

        // Delete the sight
        $sight->delete();

        // Redirect back with a success message
        return redirect()->route('countries.show', $sight->country_id)->with('success', 'Sight deleted successfully.');
    }
}
