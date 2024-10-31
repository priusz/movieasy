<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class UserController extends Controller
{
    public function getRegisterPage(): View
    {
        return view('guest.register');
    }
}
