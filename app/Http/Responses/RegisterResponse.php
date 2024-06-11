<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class RegisterResponse implements RegisterResponseContract
{
    public function toResponse($request)
    {

        return $request->wantsJson()
                    ? response()->json(['two_factor' => false])
                    : redirect()->intended(
                        !auth()->user()->roles()->exists() ? route('profile.create')  : (auth()->user()->hasRole('admin') || auth()->user()->hasRole('admin') || auth()->user()->hasRole('ustadz') ? route('dashboard') : route('home'))
                    );
    }
}