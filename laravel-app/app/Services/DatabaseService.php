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

    public function getFetchResult(array $filters) : array
    {
        $result = $this->databaseRepository->getFetchResult($filters);

        return $result;
    }

    public function fetchAll(array $filters, array $fetchResult) : array
    {
        $result = $this->databaseRepository->fetchAll($filters, $fetchResult);

        return $result;
    }

    public function getDataWithPoster() : void
    {
        $this->databaseRepository->getDataWithPoster();
    }

    public function getSortedData(string $value) : void
    {
        $this->databaseRepository->getSortedData($value);
    }

//    public function getDataByPage(int $pageNumber, array $array) : array
//    {
//        $result = $this->databaseRepository->getDataByPage($pageNumber, $array);
//
//        return $result;
//    }

}