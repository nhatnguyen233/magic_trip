<?php

namespace App\Repositories\Host;

use Prettus\Repository\Contracts\RepositoryInterface;

interface HostRepository extends RepositoryInterface
{
    public function createHost(array $params, $userId);
    public function deleteHost($host);
    public function updateBaseInfo(array $params, $hostId);
}
