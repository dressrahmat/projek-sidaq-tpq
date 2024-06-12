<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = auth()->user();

        if ($request->wantsJson()) {
            return response()->json(['two_factor' => false]);
        }

        if ($user->profile == null) {
            return redirect()->route('profile.create');
        }

        if (! $user->roles()->exists()) {
            return redirect()->route('beranda');
        }

        if ($user->hasRole('admin') || $user->hasRole('ustadz')) {
            return redirect()->route('dashboard');
        }

        return redirect()->route('home');
    }
}
