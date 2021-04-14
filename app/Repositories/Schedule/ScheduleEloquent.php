<?php

namespace App\Repositories\Schedule;

use App\Models\Schedule;
use App\Repositories\BookTour\BookTourRepository;
use Illuminate\Container\Container as Application;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;

class ScheduleEloquent extends BaseRepository implements ScheduleRepository
{
    protected $bookTourRepository;

    public function __construct(Application $app, BookTourRepository $bookTourRepository)
    {
        $this->bookTourRepository = $bookTourRepository;
        parent::__construct($app);
    }

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

    public function checkScheduleFullSlot($tour_id, $date, $number_of_booking)
    {
        $schedules = $this->findWhere(['tour_id' => $tour_id, 'departure_time' => $date]);

        if($schedules->count() == 0)
        {
            return true;
        }

        $number_max_slots = $schedules->pluck('number_max_slots')[0];
        $booked_count = array_sum($this->bookTourRepository->findWhere(['tour_id' => $tour_id, 'date_of_book' => $date])->pluck('number_of_slots')->toArray());

        if($number_of_booking <= ($number_max_slots - $booked_count))
        {
            return false;
        }

        return true;
    }

    public function getTourSchedules(array $params, $tour_id)
    {
        return $this->model
            ->join('tours', 'schedules.tour_id', '=', 'tours.id')
            ->select('schedules.id', 'schedules.tour_id', 'schedules.departure_time', 'schedules.number_max_slots')
            ->when(isset($params['start_time']), function ($q) use ($params) {
                $q->whereDate('schedules.departure_time', '>=', date('Y-m-d', strtotime($params['start_time'])));
            })
            ->when(isset($params['end_time']), function ($q) use ($params) {
                $q->whereDate('schedules.departure_time', '<=', date('Y-m-d', strtotime($params['end_time'])));
            })
            ->where('schedules.tour_id', $tour_id)
            ->groupBy('schedules.id','schedules.departure_time', 'schedules.number_max_slots', 'schedules.tour_id')
            ->get();
    }
}
