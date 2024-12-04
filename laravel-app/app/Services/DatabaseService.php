<?php

namespace App\Services;

use App\Repositories\DatabaseRepository;

class DatabaseService
{
    protected DatabaseRepository $databaseRepository;

    public function __construct(DatabaseRepository $databaseRepository)
    {
        $this->databaseRepository = $databaseRepository;
    }

    public function getFilteredData(array $filters) : array
    {
        $result = $this->databaseRepository->getFilteredData($filters);

        return $result;
    }

    public function getSortedData(string $value, array $array) : array
    {
        return [];
    }
}
