<?php

namespace App\Http\Controllers\Auth;

use App\Services\UserService;
use Illuminate\Http\RedirectResponse;

class AuthUserController
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function logout(): RedirectResponse
    {
        auth()->logout();
        return redirect()->route('welcome')->with('status', 'You have been logged out!');
    }
}
