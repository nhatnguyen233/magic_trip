<?php

namespace App\Repositories\Event;

use Prettus\Repository\Contracts\RepositoryInterface;

interface EventRepository extends RepositoryInterface
{
    public function getList(array $params);

    public function createEvent(array $params);

    public function updateTour(array $params, $id);

    public function removeTour($tour);
}
