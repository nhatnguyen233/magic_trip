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

    public function getList($params)
    {
        return $this->model
            ->join('tour_infos', 'tour_infos.tour_id', '=', 'tours.id')
            ->join('attractions', 'tour_infos.attraction_id', '=', 'attractions.id')
            ->join('provinces', 'attractions.province_id', '=', 'provinces.id')
            ->select('tours.id', 'tours.name', 'tours.host_id', 'tours.user_id', 'tours.description',
                'tours.program', 'tours.vehicle', 'tours.price', 'tours.avatar', 'tours.thumbnail', 'tours.created_at',
                'tours.updated_at','tours.total_time')
            ->when(isset($params['description']), function ($q) use ($params) {
                $q->where('tours.description', 'like', '%' . $params['description'] . '%')
                    ->orWhere('tours.name', 'like', '%' . $params['description'] . '%');
            })
            ->when(isset($params['address']), function ($q) use ($params) {
                $q->where('attractions.address', 'like', '%' . $params['address'] . '%')
                    ->orWhere('provinces.name', 'like', '%' . $params['address'] . '%');
            })
            ->when(isset($params['province_id']), function ($q) use ($params) {
                $q->where('provinces.id', $params['province_id']);
            })
            ->groupBy('tours.id', 'tours.name', 'tours.host_id', 'tours.user_id', 'tours.description',
                'tours.program', 'tours.vehicle', 'tours.price', 'tours.avatar', 'tours.thumbnail', 'tours.created_at',
                'tours.updated_at','tours.total_time')
            ->get();
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
                return in_array($key, ['user_id', 'host_id', 'name', 'description', 'program', 'price',
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

    public function updateTour(array $params, $id)
    {
        try {
            DB::beginTransaction();
            $tour = $this->find($id);

            if (isset($params['avatar'])) {
                Storage::disk('s3')->delete($tour->avatar);
                $fileName = Str::uuid() . '.' . $params['avatar']->getClientOriginalExtension();
                $fullPath = 'tours/avatars/' . time() . $fileName;
                Storage::disk('s3')->put($fullPath, file_get_contents($params['avatar']), 'public');
                $params['avatar'] = $fullPath;
            }

            if (isset($params['thumbnail'])) {
                Storage::disk('s3')->delete($tour->thumbnail);
                $fileName = Str::uuid() . '.' . $params['thumbnail']->getClientOriginalExtension();
                $fullPath = 'tours/thumbnail/' . time() . $fileName;
                Storage::disk('s3')->put($fullPath, file_get_contents($params['thumbnail']), 'public');
                $params['thumbnail'] = $fullPath;
            }

            $data = array_filter($params, function ($key) {
                return in_array($key, ['user_id', 'host_id', 'name', 'description', 'program', 'price',
                    'vehicle', 'total_time', 'avatar', 'thumbnail']);
            }, ARRAY_FILTER_USE_KEY);

            $tour->update($data);
            DB::commit();

            return $tour;
        } catch (Exception $exception) {
            Log::error($exception);
            DB::rollBack();
            throw $exception;
        }
    }

    public function removeTour($tour)
    {
        try {
            DB::beginTransaction();

            $tour->delete();

            DB::commit();

            return true;
        } catch (Exception $exception) {
            Log::error($exception);
            DB::rollBack();
            throw $exception;
        }
    }

    public function getTourName()
    {
        return $this->orderBy('id', 'DESC')->pluck('name', 'id')->toArray();;
    }
}
