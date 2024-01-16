<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

/**
 * Class ProfileController
 * @package App\Http\Controllers
 */
class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     *
     * @param  \App\Http\Requests\ProfileUpdateRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        /**
         * Fill the user's profile with validated data from the request.
         */
        $request->user()->fill($request->validated());

        /**
         * If the user's email is updated, reset the email verification timestamp.
         */
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        /**
         * Save the updated user profile.
         */
        $request->user()->save();

        /**
         * Redirect back to the profile edit page with a success message.
         */
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        /**
         * Validate the request for user account deletion.
         */
        $request->validateWithBag('userDeletion', [
            'senha' => ['required', 'senha_atual'],
        ]);

        /**
         * Get the user from the request.
         */
        $user = $request->user();

        /**
         * Logout the user.
         */
        Auth::logout();

        /**
         * Delete the user's account.
         */
        $user->delete();

        /**
         * Invalidate the user's session, regenerate the session token, and redirect to the home page.
         */
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
