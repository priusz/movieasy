<?php

namespace App\Http\Controllers\Collection;

use App\Http\Controllers\Database\DatabaseController;
use App\Services\CollectionService;
use App\Services\DatabaseService;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
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

    public function getCollectionPage(): View {

        $itemsOnTheList = $this->collectionService->getItemsOnTheList();

        $items = [];

        foreach ($itemsOnTheList as $item) {

            $items[] = $this->databaseController->getDetailsData($item['imdbID'], $item['season'], $item['episode']);

        }

        session::put('allCollection', $items);
        session::put('actualCollection', $items);

        return view('collection.collection')->with(['items' => $items]);

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

    public function getFilteredItems(string $title, string $listType, string $itemType) : View {

        $collection = session('allCollection');

        if ($title === 'emptyValue') {

            $actualItems = $collection;

        } else {

            $actualItems = array_filter($collection, function ($item) use ($title) {
                return str_contains(strtolower($item[0]['Title']), strtolower($title));
            });

        }

        $actualItems = array_filter($actualItems, function ($item) use ($listType) {

                if ($listType === "favorite") {
                    return $item[0]['favorite'];
                } else if ($listType === "watchlist") {
                    return $item[0]['watchlist'];
                } else if ($listType === "both") {
                    return $item[0]['favorite'] && $item[0]['watchlist'];
                } else {
                    return true;
                }

        });

        $actualItems = array_filter($actualItems, function ($item) use ($itemType) {

            if ($itemType === "movie") {
                return (isset($item[0]['Type']) && $item[0]['Type'] === $itemType);
            } else if ($itemType === "series") {
                return (isset($item[0]['Type']) && $item[0]['Type'] === $itemType);
            } else if ($itemType === "season") {
                return isset($item[0]['Season']);
            } else if ($itemType === "episode") {
                return (isset($item[0]['Type']) && $item[0]['Type'] === $itemType);
            } else {
                return true;
            }

        });

        session(['actualCollection' => $actualItems]);

        return view('collection.results')->with('items', session('actualCollection'));

    }

    public function getSortedItems(string $state) : View {

        $actualCollection = session('actualCollection');

        if ($state === 'noSort' || $state === 'ZA') {
            usort($actualCollection, function ($a, $b) {
                return strcasecmp($a[0]['Title'], $b[0]['Title']);
            });
        } else {
            usort($actualCollection, function ($a, $b) {
                return strcasecmp($b[0]['Title'], $a[0]['Title']);
            });
        }

        session(['actualCollection' => $actualCollection]);

        return view('collection.results')->with(['items' => $actualCollection]);

    }

}
