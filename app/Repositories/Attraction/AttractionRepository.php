<?php

namespace App\Repositories\Attraction;

use Prettus\Repository\Contracts\RepositoryInterface;

interface AttractionRepository extends RepositoryInterface
{
    public function createAttraction(array $params);

    public function updateAttraction(array $params, $id);

    public function removeAttraction($id);

    public function updateAttractionImages(array $images, $id, $userId);
}
