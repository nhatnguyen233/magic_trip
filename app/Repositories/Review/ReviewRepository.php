<?php

namespace App\Repositories\Review;

use Prettus\Repository\Contracts\RepositoryInterface;

interface ReviewRepository extends RepositoryInterface
{
    public function createReview(array $params);
    public function getList($tourId);
}
