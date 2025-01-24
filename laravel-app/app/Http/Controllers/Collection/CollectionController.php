<?php

namespace App\Http\Controllers\Collection;

use App\Services\CollectionService;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class CollectionController
{
    protected CollectionService  $collectionService;

    public function __construct(CollectionService  $collectionService)
    {
        $this->collectionService = $collectionService;
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

                if ($target === 'item-my-list') {
                    $result['onTheList'] = !$result['onTheList'];
                    if (!$result['onTheList']) {
                        $result['favorite'] = false;
                        $result['watchlist'] = false;
                    }
                }
                else if ($target === 'item-favorite') $result['favorite'] = !$result['favorite'];
                else if ($target === 'item-watchlist') $result['watchlist'] = !$result['watchlist'];

                if (count(session('allResults')) == 1) {
                    $allResults[0] = $result;
                    session(['allResults' => $allResults]);
                } else {
                    $currentPageData = session('actualResults')['Search'][session('currentPage') - 1];
                    foreach ($currentPageData as &$item) {
                        if ($item['imdbID'] === $id) {
                            if ($target === 'item-my-list') {
                                $item['onTheList'] = $result['onTheList'];
                                if (!$result['onTheList']) {
                                    $item['favorite'] = false;
                                    $item['watchlist'] = false;
                                }
                            }
                            else if ($target === 'item-favorite') $item['favorite'] = $result['favorite'];
                            else if ($target === 'item-watchlist') $item['watchlist'] = $result['watchlist'];

                            break;
                        }
                    }
                    $actualResults = session('actualResults');
                    $actualResults['Search'][session('currentPage') - 1] = $currentPageData;
                    session(['actualResults' => $actualResults]);
                }

                return view('database.item.singleResult')->with('result', $result);
            } else {
                return redirect()->back()->with('error', 'Something went wrong! 😕');
            }

        } catch (Exception $e) {
            Log::error('Update an item error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error! 😕')->withInput();
        }
    }
}
