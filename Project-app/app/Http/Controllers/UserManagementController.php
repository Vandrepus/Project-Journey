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
    public function index()
    {
        $users = User::paginate(10);
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
        $user = User::findOrFail($id);

        $user->usertype = $request->usertype;
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }
}
