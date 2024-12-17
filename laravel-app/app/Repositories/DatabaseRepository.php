<?php

namespace App\Repositories;

use App\DBConnection\Connection;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;
use PDO;

class DatabaseRepository
{
    protected PDO $pdo;

    public function __construct()
    {
        $this->pdo = Connection::connect();
    }

    public function getFetchResult (array $filters) : array
    {
        $client = new Client();
        $url = env('OMDB_API_URL');

        if (!$filters['id']) {
            $queryParams = [
                's' => '*' . $filters['title'] . '*',
                'y' => $filters['release'],
                'type' => $filters['type'] != 'all' ? $filters['type'] : '',
                'r' => 'json',
                'page' => $filters['page'] ?? 1,
                'apikey' => env('OMDB_API_KEY')
            ];
        } else {
            $queryParams = [
                'i' => 'tt' . $filters['id'],
                'r' => 'json',
                'apikey' => env('OMDB_API_KEY')
            ];
        }

        $response = $client->get($url, [
            'query' => $queryParams,
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);

        $fetchResult = json_decode($response->getBody(), true);

        return $fetchResult;
    }

    public function fetchAll(array $filters, array $fetchResult) : array
    {
        $totalPageNumber = ceil($fetchResult['totalResults'] / 10);
        $fetchResult['Search'] = [];

        if ($totalPageNumber <= 100) {
            for ($i = 1; $i <= $totalPageNumber; $i++) {
                $filters['page'] = $i;
                $resultByPage = $this->getFetchResult($filters);
                $fetchResult['Search'][] = $resultByPage['Search'];
            }
        } else {
            $pagesArray = range(1, $totalPageNumber);
            $randomIndexes = array_rand($pagesArray, 10);
            $randomPages = array_map(function ($index) use ($pagesArray) {
                return $pagesArray[$index];
            }, $randomIndexes);

            foreach ($randomPages as $page) {
                $filters['page'] = $page;
                $resultByPage = $this->getFetchResult($filters);
                $fetchResult['Search'][] = $resultByPage['Search'];
            }

            $fetchResult['totalResults'] = 100;
        }

        return $fetchResult;
    }

    public function getDataWithPoster() : void
    {
        $actualResults = session::get('actualResults');

        $result = [];
        foreach ($actualResults['Search'] as $page) {
            $result = array_merge($result, array_filter($page, function ($item) {
                return $item['Poster'] !== 'N/A';
            }));
        }

        $result['Search'] = array_chunk($result, 10);

        $result['totalResults'] = array_reduce($result['Search'], function ($carry, $page) {
            return $carry + count($page);
        }, 0);

        session::put('actualResults', $result);
    }

    public function getSortedData(string $value): void
    {
        $actualResults = session::get('actualResults');

        $mergedResults = array_merge(...$actualResults['Search']);

        $sortField = $this->getSortField($value);
        $sortDirection = $this->getSortDirection($value);

        usort($mergedResults, function ($a, $b) use ($sortField, $sortDirection) {
            $valueA = $a[$sortField];
            $valueB = $b[$sortField];

            if ($sortDirection === 'asc') {
                return strcmp($valueA, $valueB);
            } else {
                return strcmp($valueB, $valueA);
            }
        });

        $chunkedResults = array_chunk($mergedResults, 10);

        $actualResults['Search'] = $chunkedResults;

        session::put('actualResults', $actualResults);
    }

    private function getSortField(string $value): string
    {
        $fields = [
            'asc-title' => 'Title',
            'desc-title' => 'Title',
            'asc-release' => 'Year',
            'desc-release' => 'Year',
//            'asc-rating' => 'imdbRating',
//            'desc-rating' => 'imdbRating',
//            'asc-runtime' => 'Runtime',
//            'desc-runtime' => 'Runtime',
        ];

        return $fields[$value];
    }

    private function getSortDirection(string $value): string
    {
        return str_contains($value, 'asc') ? 'asc' : 'desc';
    }


//    public function getDataByPage(int $pageNumber, array $array)
//    {
//    }

}
