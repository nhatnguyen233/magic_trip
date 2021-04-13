<?php

namespace App\Repositories\Schedule;

use Prettus\Repository\Contracts\RepositoryInterface;

interface ScheduleRepository extends RepositoryInterface
{
    public function createSchedule(array $params);

    public function updateSchedule(array $params, $id);

    public function getTourSchedules(array $params, $tour_id);

    public function checkScheduleExists($tour_id, $departure_time);

    public function checkScheduleFullSlot($tour_id, $date, $number_of_slots);
}
