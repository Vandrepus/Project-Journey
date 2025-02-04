<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

/**
 * Šis kontrolieris pārvalda lietotāja profila darbības, piemēram, 
 * profila rediģēšanu, atjaunināšanu un dzēšanu.
 *
 * This controller manages user profile actions such as editing, 
 * updating, and deleting profiles.
 */
class ProfileController extends Controller
{
    /**
     * Parāda lietotāja profila rediģēšanas lapu.
     *
     * Displays the user profile edit page.
     *
     * @param Request $request
     * @return View
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Atjaunina lietotāja profila informāciju.
     *
     * Updates the user's profile information.
     *
     * @param ProfileUpdateRequest $request
     * @return RedirectResponse
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $user = $request->user();
        /**
         * Apstrādā profila attēla augšupielādi
         * Handle profile picture upload
         */
        if ($request->hasFile('profile_picture')) {
            /**
             * Dzēš veco profila attēlu, ja tāds eksistē
             * Delete the old profile picture if it exists
             */ 
            if ($user->profile_picture && Storage::exists('public/' . $user->profile_picture)) {
                Storage::delete('public/' . $user->profile_picture);
            }
            /**
             * Saglabā jauno profila attēlu
             * Store the new profile picture
             */
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            /**
             * Saglabā attēla ceļu datubāzē
             * Save the file path to the database
             */
            $validatedData['profile_picture'] = $path;
        }
        
        $user->update($validatedData);
        /**
         * Atiestata e-pasta verifikāciju, ja e-pasts tiek mainīts
         * Reset email verification if the email changes
         */
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
            $user->save();
        }

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Dzēš lietotāja kontu.
     *
     * Deletes the user's account.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        /**
         * Validē lietotāja paroles ievadi pirms konta dzēšanas
         * Validate user password before deleting the account
         */ 
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        /**
         * Dzēš profila attēlu, ja tas eksistē
         * Delete profile picture if it exists
         */
        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
        }
        Auth::logout();
        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
