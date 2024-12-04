<?php

namespace App\Repositories;

use App\DBConnection\Connection;
use GuzzleHttp\Client;
use PDO;

class DatabaseRepository
{
    protected PDO $pdo;

    public function __construct()
    {
        $this->pdo = Connection::connect();
    }

    public function getFilteredData (array $filters) : array
    {
        $client = new Client();
        $url = env('OMDB_API_URL');

        if (!$filters['id']) {
            $queryParams = [
                's' => '*' . $filters['title'] . '*',
                'y' => $filters['release'],
                'type' => $filters['type'],
                'r' => 'json',
                'apikey' => env('OMDB_API_KEY')
            ];
        } else {
            $queryParams = [
                'i' => 'tt' . $filters['id'],
                'apikey' => env('OMDB_API_KEY')
            ];
        }

        $response = $client->get($url, [
            'query' => $queryParams,
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);

        $result = json_decode($response->getBody(), true);

        if ($filters['poster'] == 'poster' && !isset($result['Error']))
        {
            if (isset($result['Search']))
            {
                $result['Search'] = array_filter($result['Search'], function ($item) {
                    return $item['Poster'] !== 'N/A';
                });
            }

//            if (isset($result['Poster']))
//            {
//                $result = $result['Poster'] == 'N/A' ?
//                    ["Response" => "False", "Error" => "Movie not found!"]
//                    : $result;
//            }
        }

        return $result;
    }
}
