<?php

namespace App\Services;

use App\Repositories\CollectionRepository;

class CollectionService
{
    protected CollectionRepository $collectionRepository;

    public function __construct(CollectionRepository $collectionRepository)
    {
        $this->collectionRepository = $collectionRepository;
    }

    public function updateItem(string $target, string $id, string $type, string $season, string $episode) : bool
    {
        $result = $this->collectionRepository->updateItem($target, $id, $type, $season, $episode);

        return $result;
    }

    public function addPersonalData(array $item, string $season, string $episode) : array
    {
        $result = $this->collectionRepository->addPersonalData($item, $season, $episode);

        return $result;
    }

    public function getItemsOnTheList() : array
    {
        $result = $this->collectionRepository->getItemsOnTheList();

        return $result;
    }

}
