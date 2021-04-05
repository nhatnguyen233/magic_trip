<?php

namespace App\Repositories\BookTour;

use Prettus\Repository\Contracts\RepositoryInterface;

interface BookTourRepository extends RepositoryInterface
{
    public function createBookTour($userId, $type, array $carts);
}
