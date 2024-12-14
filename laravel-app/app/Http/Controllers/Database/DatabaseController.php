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

        $title = $request->input('title') ? $request->input('title') : "";
        $id = $request->input('id') ? $request->input('id') : "";
        $release = $request->input('release') ? $request->input('release') : "";
        $type = $request->input('type') ? $request->input('type') : "";

        $filters = [
            'title' => $title,
            'id' => $id,
            'release' => $release,
            'type' => $type
        ];

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
            ]);
        }

        if ($fetchResult['totalResults'] <= 10) {
            session(['allResults' => $fetchResult['Search']]);

            return view('database.database')->with([
                'total' => $fetchResult['totalResults'],
                'results' => $fetchResult['Search'],
                'filters' => $filters,
            ]);
        }

        $allResult = $this->databaseService->fetchAll($filters, $fetchResult);

//        dd($allResult);

        session(['allResults' => $allResult,
            'actualResults' => $allResult,
            'actualPage' => 1]);

        return view('database.database')->with([
            'total' => $allResult['totalResults'],
            'results' => $allResult['Search'][0],
            'filters' => $filters
        ]);
    }

    public function getDatabasePageWithSortedData(Request $request)
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
            'results' => session::get('actualResults')['Search'][0],
            'filters' => $filters,
        ]);

//        dd(session::get('allResults'));

    }

}
