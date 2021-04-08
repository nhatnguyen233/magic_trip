<?php

namespace App\Repositories\TourInfo;

use Prettus\Repository\Contracts\RepositoryInterface;

interface TourInfoRepository extends RepositoryInterface
{
    public function createTourInfo(array $params);
}
