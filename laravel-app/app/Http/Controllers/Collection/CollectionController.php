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

    public function updateMyList(string $id) {

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
            $success = $this->collectionService->updateMyList($id, $type);

            if ($success) {
                $result['onTheList'] = !$result['onTheList'];

                if (count(session('allResults')) == 1) {
                    $allResults[0] = $result;
                    session(['allResults' => $allResults]);
                } else {
                    $currentPageData = session('actualResults')['Search'][session('currentPage') - 1];
                    foreach ($currentPageData as &$item) {
                        if ($item['imdbID'] === $id) {
                            $item['onTheList'] = $result['onTheList'];
                            break;
                        }
                    }
                    $actualResults = session('actualResults');
                    $actualResults['Search'][session('currentPage') - 1] = $currentPageData;
                    session(['actualResults' => $actualResults]);
                }

                return view('database.item.singleResult')->with('result', $result);
            } else {
                return redirect()->back()->with('error', 'Something went wrong, item not added to your collection! 😕');
            }

        } catch (Exception $e) {
            Log::error('Add to collection list error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error! 😕')->withInput();
        }
    }
}
