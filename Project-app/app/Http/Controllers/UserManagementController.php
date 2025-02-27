<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * Šis kontrolieris pārvalda lietotāju pārvaldību administratoriem.
 * Administratoriem ir iespēja skatīt, rediģēt un mainīt lietotāju tiesības.
 *
 * This controller manages user administration.
 * Admins can view, edit, and update user roles.
 */
class UserManagementController extends Controller
{
    /**
     * Parāda lietotāju sarakstu ar lapošanu.
     *
     * Displays a paginated list of users.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Filter by search (username)
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('username', 'like', "%{$search}%");
        }

        // Filter by user type (e.g., admin)
        if ($request->filled('filter') && $request->input('filter') == 'admin') {
            $query->where('usertype', 'admin');
        }

        // Paginate and preserve query parameters
        $users = $query->paginate(10)->appends($request->query());

        return view('admin.UserManagement.index', compact('users'));
    }

    /**
     * Parāda rediģēšanas formu konkrētam lietotājam.
     *
     * Displays the edit form for a specific user.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.UserManagement.edit', compact('user'));
    }

    /**
     * Atjaunina lietotāja datus, piemēram, lietotāja lomu.
     *
     * Updates the user's data, such as user role.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Validate the user type and, if the user is banned, the ban reason is required.
        $validatedData = $request->validate([
            'usertype'   => 'required|in:user,admin',
            'ban_reason' => 'required_if:banned,1|string'
        ]);

        $user = User::findOrFail($id);
        $user->usertype = $validatedData['usertype'];

        // Determine if the ban checkbox is checked.
        $isBanned = $request->has('banned');
        $user->banned = $isBanned;

        // If banned, update the ban reason; otherwise, clear it.
        if ($isBanned) {
            $user->ban_reason = $validatedData['ban_reason'];
        } else {
            $user->ban_reason = null;
        }

        $user->save();

        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }
}
