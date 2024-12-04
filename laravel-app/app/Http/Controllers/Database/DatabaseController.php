<?php

namespace App\Http\Controllers\Database;

use App\Services\DatabaseService;
use Illuminate\Http\Request;
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
                'id' => 'required_without:title|numeric|nullable',
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
        $poster = $request->input('poster') ? $request->input('poster') : "";

        $filters = [
            'title' => $title,
            'id' => $id,
            'release' => $release,
            'type' => $type,
            'poster' => $poster
        ];

        $result = $this->databaseService->getFilteredData($filters);

        if (isset($result['Response']) && $result['Response'] == 'False') {

            return view('database.database')->with([
                'total' => 0,
                'results' => [],
                'filters' => $filters,
                'error' => $result['Error']
            ]);
        }

        $totalResults = $result['totalResults'] ?? 1;

        return view('database.database')->with([
            'total' => $totalResults,
            'results' => $totalResults == 1 ? [$result] : $result['Search'],
            'filters' => $filters
        ]);
    }
}
