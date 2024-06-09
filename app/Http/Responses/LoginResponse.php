<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        return $request->wantsJson()
                    ? response()->json(['two_factor' => false])
                    : redirect()->intended(
                        auth()->user()->hasRole('admin') || auth()->user()->hasRole('admin') || auth()->user()->hasRole('ustadz') ? route('dashboard') : route('home')
                    );
    }
}