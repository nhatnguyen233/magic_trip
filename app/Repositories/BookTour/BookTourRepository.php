<?php

namespace App\Repositories\BookTour;

use Prettus\Repository\Contracts\RepositoryInterface;

interface BookTourRepository extends RepositoryInterface
{
    public function getBookTourByHostID($hostID, $params);

    public function createBookTour($userId, $type, array $carts);

    public function payment($userId);
}
