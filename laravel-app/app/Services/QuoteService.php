<?php

namespace App\Services;

use App\Repositories\QuoteRepository;

class QuoteService
{
    protected QuoteRepository $quoteRepository;

    public function __construct(QuoteRepository $quoteRepository) {
        $this->quoteRepository = $quoteRepository;
    }

    public function getRandomQuote() : object {
        return $this->quoteRepository->getRandomQuote();
    }
}
