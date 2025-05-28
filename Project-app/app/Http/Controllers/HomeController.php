<?php

namespace App\Http\Controllers;

use App\Models\Sight;

class HomeController extends Controller
{
    public function index()
    {
        
        $sights = Sight::where('visible', true)->get();

        $recentSights = Sight::where('visible', true)
            ->has('reviews') 
            ->withMax('reviews', 'created_at') 
            ->orderByDesc('reviews_max_created_at')
            ->take(3)
            ->get();

        /
        return view('home', [
            'sights' => $sights,
            'recentSights' => $recentSights,
        ]);
    }
}