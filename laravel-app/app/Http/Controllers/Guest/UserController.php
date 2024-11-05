<?php

namespace App\Http\Controllers\Guest;

use App\Services\UserService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class UserController
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getRegisterPage(): View
    {
        return view('guest.register');
    }

    public function register(Request $request) : RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|lowercase|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/',
        ]);

        try {
            $success = $this->userService->createUser($request);

            if ($success) {
                if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
                    return redirect()->route('dashboard')->with('status', 'Registration successful!');
                }
                return redirect()->back()->with('error', 'Login failed!')->withInput();
            } else {
                return redirect()->back()->with('error', 'Registration failed!')->withInput();
            }

        } catch (Exception $e) {
            Log::error('Registration error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error!')->withInput();
        }
    }

    public function getLoginPage(): View
    {
        return view('guest.login');
    }

    public function login(Request $request) : RedirectResponse
    {
        $request->validate([
            'email' => 'required|string|email|lowercase|max:255',
            'password' => 'required|string|min:8',
        ]);

        try {
            $userExists = $this->userService->checkUserExists($request->email);

            if (!$userExists) {
                return redirect()->back()->with('error', 'This email is not registered!')->withInput();
            }

            if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->route('dashboard')->with('status', 'Login successful!');
            }
            return redirect()->back()->with('error', 'Login failed!')->withInput();

        } catch (Exception $e) {
            Log::error('Login error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error!')->withInput();
        }
    }
}
