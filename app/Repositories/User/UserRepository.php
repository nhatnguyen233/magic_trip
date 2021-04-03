<?php

namespace App\Repositories\User;

use Prettus\Repository\Contracts\RepositoryInterface;

interface UserRepository extends RepositoryInterface
{
    public function updateBaseInfo(array $params);
    public function createUserInfo(array $params);
    public function getUserLoginWithRelation();
}
