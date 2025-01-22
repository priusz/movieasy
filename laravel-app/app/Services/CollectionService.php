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

    public function updateItem(string $target, string $id, string $type) : bool
    {
        $result = $this->collectionRepository->updateItem($target, $id, $type);

        return $result;
    }

    public function addPersonalData(array $item) : array
    {
        $result = $this->collectionRepository->addPersonalData($item);

        return $result;
    }

}
