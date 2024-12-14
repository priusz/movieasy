<?php

namespace App\Http\Controllers\Auth;

use App\Services\QuoteService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuthUserController
{
    protected QuoteService $quoteService;

    public function __construct(QuoteService $quoteService)
    {
        $this->quoteService = $quoteService;
    }

    public function getHomePage(): View
    {
        $quote = $this->quoteService->getRandomQuote();
        return view('auth.home', ['quote' => $quote]);
    }

    public function logout(): RedirectResponse
    {
        auth()->logout();
        return redirect()->route('welcome')->with('status', 'You have been logged out! 😊');
    }
}
