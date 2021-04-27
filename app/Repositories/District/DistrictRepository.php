<?php

namespace App\Repositories\District;

use Prettus\Repository\Contracts\RepositoryInterface;

interface DistrictRepository extends RepositoryInterface
{
    public function search(array $params);
}
