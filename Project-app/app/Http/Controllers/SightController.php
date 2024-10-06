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
}
