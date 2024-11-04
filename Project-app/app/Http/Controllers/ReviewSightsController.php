<?php

namespace App\Http\Controllers;

use App\Models\Sight;
use Illuminate\Http\Request;

class ReviewSightsController extends Controller
{
    public function index()
    {
        $pendingSights = Sight::where('visible', 0)->get();
        return view('admin.sights.index', compact('pendingSights'));
    }

    public function show($id)
    {
        $sight = Sight::findOrFail($id);
        return view('admin.sights.show', compact('sight'));
    }

    public function approve($id)
    {
        $sight = Sight::findOrFail($id);
        $sight->update(['visible' => 1]); // Make sight visible
        return redirect()->back()->with('success', 'Sight approved successfully!');
    }

    public function decline($id)
    {
        $sight = Sight::findOrFail($id);
        $sight->delete(); // Delete the sight from the database
        return redirect()->back()->with('success', 'Sight declined and removed from the database.');
    }
}
