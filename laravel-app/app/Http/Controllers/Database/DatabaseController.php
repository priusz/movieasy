<?php

namespace App\Http\Controllers\Database;

use App\Services\CollectionService;
use App\Services\DatabaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class DatabaseController
{
    protected DatabaseService  $databaseService;
    protected CollectionService $collectionService;

    public function __construct(DatabaseService  $databaseService, CollectionService $collectionService)
    {
        $this->databaseService = $databaseService;
        $this->collectionService = $collectionService;
    }

    public function getDatabasePage() : View
    {
        session::forget('allResults');
        session::forget('actualResults');
        session::put('currentPage', 1);
        session::put('maxPage', 1);

        return view('database.database');
    }

    public function getDatabasePageWithFilteredData(Request $request)
    {
        $request->validate(
            [
                'title' => 'required_without:id|string|min:3|max:255|nullable',
                'id' => 'required_without:title|string|regex:/^tt\d{7,}$/|nullable',
            ],
            [
                'title.required_without' => 'The title or the id field is required!',
                'id.required_without' => 'The title or the id field is required!',
                'id.regex' => 'The id must start with "tt" followed by at least 7 digits!'
            ]
        );

        $filters = $this->setFilters($request);

//        session::forget('allResults');
//        session::forget('actualResults');
        session::put('currentPage', 1);
        session::put('maxPage', 1);

        $season = 0;
        $episode = 0;

        $fetchResult = $this->databaseService->getFetchResult($filters);

        if ($fetchResult['Response'] == 'False') {

            return view('database.database')->with([
                'total' => 0,
                'results' => [],
                'filters' => $filters,
                'error' => $fetchResult['Error']
            ]);
        }

        if (!isset($fetchResult['totalResults'])) {

            $fetchResult = $this->collectionService->addPersonalData($fetchResult, $season, $episode);

            session(['allResults' => [$fetchResult]]);

            return view('database.database')->with([
                'total' => 1,
                'results' => [$fetchResult],
                'filters' => $filters,
                'currentPage' => session('currentPage'),
                'maxPage' => session('maxPage'),
            ]);
        }

        if ($fetchResult['totalResults'] <= 10) {

            $fetchResult['Search'] = array_map(function ($item) use ($season, $episode) {
                return $this->collectionService->addPersonalData($item, $season, $episode);
            }, $fetchResult['Search']);

            $fetchResult['Search'] = [$fetchResult['Search']];

            session(['allResults' => $fetchResult,
                'actualResults' => $fetchResult]);

            return view('database.database')->with([
                'total' => $fetchResult['totalResults'],
                'results' => $fetchResult['Search'][session::get('currentPage') - 1],
                'filters' => $filters,
                'currentPage' => session('currentPage'),
                'maxPage' => session('maxPage'),
            ]);
        }

        $allResult = $this->databaseService->fetchAll($filters, $fetchResult);

        $allResult['Search'][session::get('currentPage') - 1] =
            array_map(function ($item) use ($season, $episode) {
                return $this->collectionService->addPersonalData($item, $season, $episode);
            }, $allResult['Search'][session::get('currentPage') - 1]);

        session(['allResults' => $allResult,
            'actualResults' => $allResult,
            'maxPage' => ceil($allResult['totalResults'] / 10) ]);

        return view('database.database')->with([
            'total' => $allResult['totalResults'],
            'results' => $allResult['Search'][session::get('currentPage') - 1],
            'filters' => $filters,
            'currentPage' => session('currentPage'),
            'maxPage' => session('maxPage'),
        ]);
    }

    public function getDatabasePageWithSortedData(Request $request) : View
    {
        $filters = $this->setFilters($request);

        $sort = $request->input('sort');
        $poster = $request->has('poster');

        $season = 0;
        $episode = 0;

        if (empty($sort) && !$poster)
        {
            session(['actualResults' => session::get('allResults')]);
        }
        else if (!empty($sort) && !$poster)
        {
            session(['actualResults' => session::get('allResults')]);

            $this->databaseService->getSortedData($sort);
        }
        else if (empty($sort) && $poster)
        {
            $this->databaseService->getDataWithPoster();
        }
        else
        {
            $this->databaseService->getDataWithPoster();
            $this->databaseService->getSortedData($sort);
        }

        session::put('currentPage', 1);
        session::put('maxPage', ceil(session::get('actualResults')['totalResults'] / 10) );

        $actualResults = session::get('actualResults');

        $actualResults['Search'][session::get('currentPage') - 1] =
            array_map(function ($item) use ($season, $episode) {
                return $this->collectionService->addPersonalData($item, $season, $episode);
            }, $actualResults['Search'][session::get('currentPage') - 1]);

        session(['actualResults' => $actualResults]);

        return view('database.database')->with([
            'total' => session::get('actualResults')['totalResults'],
            'results' => session::get('actualResults')['Search'][session::get('currentPage') - 1] ?? [],
            'filters' => $filters,
            'currentPage' => session('currentPage'),
            'maxPage' => session('maxPage'),
        ]);

    }

    private function setFilters(Request $request) : array
    {
        $title = $request->input('title', '');
        $id = $request->input('id', '');
        $release = $request->input('release', '');
        $type = $request->input('type', '');

        if (empty($id)) {
            $filters = [
                'title' => $title,
                'release' => $release,
                'type' => $type
            ];
        }
        else
        {
            $filters = [
                'id' => $id,
            ];
        }

        return $filters;
    }

    public function updatePage(Request $request) : View
    {
        $currentPage = $request->input('currentPage');
        session(['currentPage' => $currentPage]);

        $season = 0;
        $episode = 0;

        $actualResults = session::get('actualResults');

        $actualResults['Search'][session::get('currentPage') - 1] =
            array_map(function ($item) use ($season, $episode) {
                return $this->collectionService->addPersonalData($item, $season, $episode);
            }, $actualResults['Search'][session::get('currentPage') - 1]);

        session(['actualResults' => $actualResults]);

        return view('database.results')->with([
            'total' => session::get('actualResults')['totalResults'],
            'results' => session::get('actualResults')['Search'][session::get('currentPage') - 1],
            'currentPage' => session('currentPage'),
            'maxPage' => session('maxPage'),
        ]);
    }

    public function getDetails(string $id, string $season, string $episode) : View {

        $result = $this->getDetailsData($id, $season, $episode);

        return view('database.item.details')->with(['details' => $result[0],
            'additionalData' => $result[1],
            'season' => $season,]);
    }

    public function getDetailsData(string $id, string $season, string $episode) : array {

        $additionalData = ($season != '0' && $episode == '0')
            ? $this->databaseService->getDetails($id, 0, 0)
            : [];

        $details = $this->databaseService->getDetails($id, $season, $episode);

        return [$details, $additionalData];
    }

}
