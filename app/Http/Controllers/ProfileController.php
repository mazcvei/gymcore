<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(): View
    {
         return view('profile.edit', [
            'user' => auth()->user(),
            'reservations' => Auth::user()->reservations,
            'suscripcion' => Auth::user()->membership ? Auth::user()->membership : [],
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
    
        $user = Auth::user();

        $data = [
            'name' => $request->name,
            'lastname' => $request->lastname,
            'phone' => $request->phone,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return Redirect::route('profile.edit')->with('success', 'Perfil actualizado correctamente.');
    }

}
