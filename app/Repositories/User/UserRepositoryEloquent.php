<?php

namespace App\Repositories\User;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;

class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    public function model()
    {
        return User::class;
    }

    /**
     * Boot up the repository, pushing criteria
     * @throws RepositoryException
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function createUserInfo(array $inputs)
    {
        try {
            DB::beginTransaction();
                $user = $this->create(array_merge([
                    'name' => $inputs['firstname'] . '' .$inputs['lastname'],
                    'email' => $inputs['email'],
                    'phone' => $inputs['phone'],
                    'role_id' => UserRole::CUSTOMER,
                    'password' => $inputs['password'],
              ]));
                        
            DB::commit();
            return $user;

     } catch (\Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
    }

    public function updateBaseInfo(array $params, $user)
    {

    }
}
