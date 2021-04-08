<?php

namespace App\Repositories\Host;

use Prettus\Repository\Contracts\RepositoryInterface;

interface HostRepository extends RepositoryInterface
{
    public function createHost(array $params, $userId);
}
