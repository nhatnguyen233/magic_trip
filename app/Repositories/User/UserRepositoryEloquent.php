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
                $user = $this->create($inputs);     
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
