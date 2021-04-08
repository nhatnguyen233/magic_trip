<?php

namespace App\Repositories\Host;

use App\Models\Host;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;

class HostRepositoryEloquent extends BaseRepository implements HostRepository
{
    public function model()
    {
        return Host::class;
    }

    /**
     * Boot up the repository, pushing criteria
     * @throws RepositoryException
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function createHost(array $params, $userId)
    {
        try {
            if (isset($params['avatar'])) {
                $fileName = Str::uuid() . '.' . $params['avatar']->getClientOriginalExtension();
                $fullPath = 'hosts/avatars/' . $fileName;
                Storage::disk('s3')->put($fullPath, file_get_contents($params['avatar']), 'public');
                $params['avatar'] = $fullPath;
            }

            if (isset($params['thumbnail'])) {
                $fileName = Str::uuid() . '.' . $params['thumbnail']->getClientOriginalExtension();
                $fullPath = 'hosts/thumbnails/' . $fileName;
                Storage::disk('s3')->put($fullPath, file_get_contents($params['thumbnail']), 'public');
                $params['thumbnail'] = $fullPath;
            }

            if(isset($userId)) {
                $params['user_id'] = $userId;
            }

            $data = array_filter($params, function ($key) {
                return in_array($key, ['user_id', 'country_id', 'identification', 'host_name', 'host_mail', 'hotline',
                    'bank_id', 'date_of_establish', 'address', 'avatar', 'thumbnail' , 'description']);
            }, ARRAY_FILTER_USE_KEY);

            return $this->create($data);
        } catch (\Exception $e) {
            Log::error($e);
            throw $e;
        }
    }
}
