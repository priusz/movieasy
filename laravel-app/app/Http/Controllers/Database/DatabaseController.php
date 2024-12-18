<?php

namespace App\Http\Controllers\Database;

use App\Services\DatabaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class DatabaseController
{
    protected DatabaseService  $databaseService;

    public function __construct(DatabaseService  $databaseService)
    {
        $this->databaseService = $databaseService;
    }

    public function getDatabasePage() : View
    {
        session::forget('allResults');
        session::forget('actualResults');
        session::put('currentPage', 1);
        return view('database.database');
    }

    public function getDatabasePageWithFilteredData(Request $request)
    {
        $request->validate(
            [
                'title' => 'required_without:id|string|min:3|max:255|nullable',
                'id' => 'required_without:title|string|min:7|nullable',
            ],
            [
                'title.required_without' => 'The title or the id field is required!',
                'id.required_without' => 'The title or the id field is required!',
            ]
        );

        if ($request->filled('title') && $request->filled('id')) {
            return redirect()->back()->with('error', 'Both title and id cannot be provided at the same time! 😕')->withInput();
        }

        $filters = $this->setFilters($request);

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
            return view('database.database')->with([
                'total' => 1,
                'results' => [$fetchResult],
                'filters' => $filters,
                'currentPage' => session('currentPage'),
            ]);
        }

        if ($fetchResult['totalResults'] <= 10) {
            session(['allResults' => $fetchResult['Search']]);

            return view('database.database')->with([
                'total' => $fetchResult['totalResults'],
                'results' => $fetchResult['Search'],
                'filters' => $filters,
                'currentPage' => session('currentPage'),
            ]);
        }

        $allResult = $this->databaseService->fetchAll($filters, $fetchResult);

//        dd($allResult);

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

    public function getDatabasePageWithSortedData(Request $request)
    {
        $filters = $this->setFilters($request);

        $sort = $request->input('sort');
        $poster = $request->has('poster');

        if ($sort == "" && !$poster)
        {
            session(['actualResults' => session::get('allResults')]);
        }
        else if ($sort != "" && !$poster)
        {
            session(['actualResults' => session::get('allResults')]);

            $this->databaseService->getSortedData($sort);
        }
        else if ($sort == "" && $poster)
        {
            $this->databaseService->getDataWithPoster();
        }
        else
        {
            $this->databaseService->getDataWithPoster();
            $this->databaseService->getSortedData($sort);
        }

        return view('database.database')->with([
            'total' => session::get('actualResults')['totalResults'],
            'results' => session::get('actualResults')['Search'][session::get('currentPage') - 1],
            'filters' => $filters,
            'currentPage' => session('currentPage'),
        ]);

//        dd(session::get('allResults'));

    }

    private function setFilters(Request $request) : array
    {
        $title = $request->input('title', '');
        $id = $request->input('id', '');
        $release = $request->input('release', '');
        $type = $request->input('type', '');

        $filters = [
            'title' => $title,
            'id' => $id,
            'release' => $release,
            'type' => $type
        ];

        return $filters;
    }

}
