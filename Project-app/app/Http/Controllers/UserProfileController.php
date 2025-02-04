<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

/**
 * Šis kontrolieris apstrādā lietotāja profila skatīšanu pēc lietotājvārda.
 * 
 * This controller handles displaying a user's profile based on their username.
 */
class UserProfileController extends Controller
{
    /**
     * Parāda konkrēta lietotāja profilu, meklējot pēc lietotājvārda.
     *
     * Displays a specific user's profile by searching for their username.
     *
     * @param string $username
     * @return \Illuminate\View\View
     */
    public function show($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        return view('user.profile', compact('user'));
    }
}
