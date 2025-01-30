<?php

namespace App\Http\Controllers\Collection;

use App\Http\Controllers\Database\DatabaseController;
use App\Services\CollectionService;
use App\Services\DatabaseService;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class CollectionController
{
    protected CollectionService  $collectionService;
    protected DatabaseService $databaseService;

    protected DatabaseController $databaseController;

    public function __construct(CollectionService  $collectionService, DatabaseService $databaseService, DatabaseController $databaseController)
    {
        $this->collectionService = $collectionService;
        $this->databaseService = $databaseService;
        $this->databaseController = $databaseController;
    }

    public function updateItem(string $target, string $id, string $season, string $episode) {

        if (count(session('allResults')) == 1) {

            $result = session('allResults')[0];

        } else {

            $currentPageData = session('actualResults')['Search'][session('currentPage') - 1];

            $result = array_values(array_filter($currentPageData, function ($item) use ($id) {
                return $item['imdbID'] == $id;
            }))[0];

        }

        $type = $result['Type'];

        try {

            $success = $this->collectionService->updateItem($target, $id, $type, $season, $episode);

            if ($success) {

                $result = $this->updateItemInTheSession($target, $id, $result);

                return view('database.item.singleResult')->with('result', $result);

            } else {

                return redirect()->back()->with('error', 'Something went wrong! 😕');
            }

        } catch (Exception $e) {

            Log::error('Update the item error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Update the item error! 😕');

        }
    }

    public function updateModal(string $target, string $id, string $season, string $episode) {

        $item = $this->databaseService->getDetails($id, $season, $episode);

        $type = $item['Type'] ?? 'season';

        $item = $this->collectionService->addPersonalData($item, $season, $episode);

        try {

//            dd($target, $id, $type, $season, $episode);

            $success = $this->collectionService->updateItem($target, $id, $type, $season, $episode);

            if ($success) {

                if ($target === 'modal-my-list') {
                    $item['onTheList'] = !$item['onTheList'];
                    if (!$item['onTheList']) {
                        $item['favorite'] = false;
                        $item['watchlist'] = false;
                    }
                }
                else if ($target === 'modal-favorite') $item['favorite'] = !$item['favorite'];
                else if ($target === 'modal-watchlist') $item['watchlist'] = !$item['watchlist'];

//                dd($item);

                $view = $this->databaseController->getDetails($id, $season, $episode);

                return $view;

            } else {
                return redirect()->back()->with('error', 'Something went wrong during update the modal! 😕');
            }

        } catch (Exception $e) {

            Log::error('Update the modal error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Update the modal error! 😕');

        }
    }

    public function refreshItem(string $target, string $id, string $type) {

        if (count(session('allResults')) == 1) {

            $result = session('allResults')[0] ?? [];

            if ($type === 'movie' || $type === 'series') {

                $refresh = isset($result['imdbID']) && $result['imdbID'] === $id
                            && $result['Type'] === $type;

            }

        } else {

            $currentPageData = session('actualResults')['Search'][session('currentPage') - 1];

            $result = array_values(array_filter($currentPageData, function ($item) use ($id, $type) {
                return $item['imdbID'] === $id && $item['Type'] === $type;
            }))[0] ?? [];

            $refresh = !empty($result);

        }

        if ($refresh) {

            try {

                $result = $this->updateItemInTheSession($target, $id, $result);

                return view('database.item.singleResult')->with('result', $result);

            } catch (Exception $e) {

                Log::error('Refresh the item error: ' . $e->getMessage());
                return redirect()->back()->with('error', 'Refresh the item error! 😕');

            }
        }

        return 'noRefresh';
    }

    private function updateItemInTheSession (string $target, string $id, array $result) : array {

        if ($target === 'item-my-list' || $target === 'modal-my-list') {
            $result['onTheList'] = !$result['onTheList'];
            if (!$result['onTheList']) {
                $result['favorite'] = false;
                $result['watchlist'] = false;
            }
        }
        else if ($target === 'item-favorite' || $target === 'modal-favorite') $result['favorite'] = !$result['favorite'];
        else if ($target === 'item-watchlist' || $target === 'modal-watchlist') $result['watchlist'] = !$result['watchlist'];

        if (count(session('allResults')) == 1) {
            $allResults[0] = $result;
            session(['allResults' => $allResults]);
        } else {
            $currentPageData = session('actualResults')['Search'][session('currentPage') - 1];
            foreach ($currentPageData as &$item) {
                if ($item['imdbID'] === $id) {
                    if ($target === 'item-my-list' || $target === 'modal-my-list') {
                        $item['onTheList'] = $result['onTheList'];
                        if (!$result['onTheList']) {
                            $item['favorite'] = false;
                            $item['watchlist'] = false;
                        }
                    }
                    else if ($target === 'item-favorite' || $target === 'modal-favorite') $item['favorite'] = $result['favorite'];
                    else if ($target === 'item-watchlist' || $target === 'modal-watchlist') $item['watchlist'] = $result['watchlist'];

                    break;
                }
            }
            $actualResults = session('actualResults');
            $actualResults['Search'][session('currentPage') - 1] = $currentPageData;
            session(['actualResults' => $actualResults]);
        }

        return $result;

    }

}
