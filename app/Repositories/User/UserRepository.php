<?php

namespace App\Repositories\User;

use Prettus\Repository\Contracts\RepositoryInterface;

interface UserRepository extends RepositoryInterface
{
    public function updateBaseInfo(array $params, $user);
}
