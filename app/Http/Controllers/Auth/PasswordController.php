<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'senha_atual' => ['required', 'senha_atual'],
            'senha' => ['required', senha::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'senha' => Hash::make($validated['senha']),
        ]);

        return back()->with('status', 'senha-updated');
    }
}
