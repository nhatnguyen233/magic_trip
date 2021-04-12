<?php

namespace App\Repositories\Schedule;

use App\Models\Schedule;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;

class ScheduleEloquent extends BaseRepository implements ScheduleRepository
{
    public function model()
    {
        return Schedule::class;
    }

    /**
     * Boot up the repository, pushing criteria
     * @throws RepositoryException
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function createSchedule(array $params)
    {
        try {
            $data = array_filter($params, function ($key) {
                return in_array($key, ['tour_id', 'departure_time', 'number_max_slots',]);
            }, ARRAY_FILTER_USE_KEY);

            return $this->create($data);
        } catch (\Exception $e)
        {
            throw $e;
        }
    }

    public function updateSchedule(array $params, $id)
    {
        try {
            $data = array_filter($params, function ($key) {
                return in_array($key, ['tour_id', 'departure_time', 'number_max_slots',]);
            }, ARRAY_FILTER_USE_KEY);

            return $this->find($id)->update($data);
        } catch (\Exception $e)
        {
            throw $e;
        }
    }

    public function checkScheduleExists($tour_id, $departure_time)
    {
        return $this->model
            ->where('tour_id', $tour_id)
            ->where('departure_time', $departure_time)
            ->exists();
    }
}
