<?php

namespace App\Repositories\Tour;

use App\Models\Tour;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;
use Exception;

class TourEloquent extends BaseRepository implements TourRepository
{
    public function model()
    {
        return Tour::class;
    }

    /**
     * Boot up the repository, pushing criteria
     * @throws RepositoryException
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function createGeneralTour(array $params)
    {
        try {
            DB::beginTransaction();

            if (isset($params['avatar'])) {
                $fileName = Str::uuid() . '.' . $params['avatar']->getClientOriginalExtension();
                $fullPath = 'tours/avatars/' . time() . $fileName;
                Storage::disk('s3')->put($fullPath, file_get_contents($params['avatar']), 'public');
                $params['avatar'] = $fullPath;
            }

            $data = array_filter($params, function ($key) {
                return in_array($key, ['user_id', 'name', 'description', 'total_price',
                    'vehicle', 'total_time', 'avatar', 'thumbnail']);
            }, ARRAY_FILTER_USE_KEY);

            $tour = $this->create($data);
            DB::commit();

            return $tour;
        } catch (Exception $exception) {
            Log::error($exception);
            DB::rollBack();
            throw $exception;
        }
    }
}
