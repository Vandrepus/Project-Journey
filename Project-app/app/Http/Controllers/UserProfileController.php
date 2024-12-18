<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function show($username)
    {
        $user = User::where('username', $username)->firstOrFail();

        return view('user.profile', compact('user'));
    }
}
