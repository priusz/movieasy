<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class QuoteRepository
{
    public function getRandomQuote()
    {
        return DB::table('movie_quotes')->inRandomOrder()->first();
    }
}
