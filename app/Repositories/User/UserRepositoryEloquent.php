<?php

namespace App\Repositories\User;

use App\Enums\UserRole;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;
use App\Repositories\Helpers\FilterTrait;

class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    use FilterTrait;

    public function model()
    {
        return User::class;
    }

    public function getList($filters = [], $sorts = [], $relations = [], $limit = 20, $select = ['*'])
    {
        $limit = $limit ?? config('common.default_per_page');
        $filterable = [];

        $query = $this->where('role_id', UserRole::CUSTOMER)
            ->orderBy('created_at', 'DESC');

        return $this->filterPaginate(
            $query,
            $limit,
            $filters,
            $sorts,
            $filterable,
            $select
        );
    }

    /**
     * Boot up the repository, pushing criteria
     * @throws RepositoryException
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function createUserInfo(array $params)
    {
        try {
            if (isset($params['avatar'])) {
                $fileName = Str::uuid() . '.' . $params['avatar']->getClientOriginalExtension();
                $fullPath = 'customers/avatars/' . $fileName;
                Storage::disk('s3')->put($fullPath, file_get_contents($params['avatar']), 'public');
                $params['avatar'] = $fullPath;
            }

            $data = array_filter($params, function ($key) {
                return in_array($key, ['name', 'email', 'phone', 'role_id', 'province_id', 'district_id',
                    'country_id', 'password', 'address', 'avatar', 'postal_code']);
            }, ARRAY_FILTER_USE_KEY);

            return $this->create($data);
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollBack();
            throw $e;
        }
    }

    public function updateBaseInfo(array $params, $userId)
    {
        try {

            if (isset($params['avatar'])) {
                $fileName = Str::uuid() . '.' . $params['avatar']->getClientOriginalExtension();
                $fullPath = 'customers/avatars/' . $fileName;
                Storage::disk('s3')->put($fullPath, file_get_contents($params['avatar']), 'public');
                $params['avatar'] = $fullPath;
            }
          
            $data = array_filter($params, function ($key) {
                return in_array($key, ['name', 'email', 'phone', 'role_id', 'province_id', 'district_id',
                    'country_id', 'password', 'address', 'avatar', 'postal_code']);
            }, ARRAY_FILTER_USE_KEY);

            $this->update($data, $userId);

            return true;
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollBack();
            throw $e;
        }
    }

    public function getUserLoginWithRelation ()
    {
        return $this->model::find(Auth::guard('customer')->user()->id);
    }

    public function getUserById($userId)
    {
        return $this->model::find($userId);
    }

    public function deleteUser($user)
    {
        try {
            DB::beginTransaction();

            $user->delete();

            DB::commit();

            return true;
        } catch (Exception $exception) {
            Log::error($exception);
            DB::rollBack();
            throw $exception;
        }
    }
}
