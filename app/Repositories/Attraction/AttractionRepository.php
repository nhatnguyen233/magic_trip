<?php

namespace App\Repositories\Attraction;

use Prettus\Repository\Contracts\RepositoryInterface;

interface AttractionRepository extends RepositoryInterface
{
    public function createAttraction(array $params);

    public function removeAttraction($id);

    public function updateAttractionImages(array $images, $id);
}
