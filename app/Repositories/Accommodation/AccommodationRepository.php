<?php

namespace App\Repositories\Accommodation;

use Prettus\Repository\Contracts\RepositoryInterface;

interface AccommodationRepository extends RepositoryInterface
{
    public function createAccommodation(array $params);

    public function updateAccommodation(array $params, $id);

    public function removeAccommodation($accommodation);

    public function insertAccommodationImages(array $images, $id, $userId);
}
