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

    public function updateMyList(string $id, string $type) : bool
    {
        $result = $this->collectionRepository->updateMyList($id, $type);

        return $result;
    }

    public function addPersonalData(array $item) : array
    {
        $result = $this->collectionRepository->addPersonalData($item);

        return $result;
    }

}
