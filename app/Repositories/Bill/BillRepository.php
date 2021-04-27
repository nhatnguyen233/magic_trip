<?php

namespace App\Repositories\Bill;

use Prettus\Repository\Contracts\RepositoryInterface;

interface BillRepository extends RepositoryInterface
{
    public function getList(array $params, $hostID);
}
