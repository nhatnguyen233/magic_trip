<?php

namespace App\Repositories\Tour;

use Prettus\Repository\Contracts\RepositoryInterface;

interface TourRepository extends RepositoryInterface
{
    public function createGeneralTour(array $params);
    public function updateTour(array $params, $id);
    public function removeTour($tour);
}
