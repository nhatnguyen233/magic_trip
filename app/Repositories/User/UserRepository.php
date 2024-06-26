<?php

namespace App\Repositories\User;

use Prettus\Repository\Contracts\RepositoryInterface;

interface UserRepository extends RepositoryInterface
{
    public function updateBaseInfo(array $params, $userId);
    public function createUserInfo(array $params);
    public function getList($role_id);
    public function deleteUser($id);
    public function getUserSocialNetWork($getInfo, $provider);
}
