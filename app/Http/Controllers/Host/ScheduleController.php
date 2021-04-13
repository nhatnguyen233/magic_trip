<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;
use App\Http\Requests\Schedule\CreateSchedule;
use App\Http\Requests\Schedule\UpdateSchedule;
use App\Http\Resources\Schedule\ScheduleCollection;
use App\Models\Schedule;
use App\Models\Tour;
use App\Repositories\Schedule\ScheduleRepository;
use App\Repositories\Tour\TourRepository;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    protected $scheduleRepository;
    protected $tourRepository;

    public function __construct(
        TourRepository $tourRepository,
        ScheduleRepository $scheduleRepository
    )
    {
        $this->scheduleRepository = $scheduleRepository;
        $this->tourRepository = $tourRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $viewData['tours'] = $this->tourRepository->findWhere(['host_id' => auth('host')->user()->host->id]);
        $viewData['schedules'] = $this->scheduleRepository->findWhereIn('tour_id', $viewData['tours']->pluck('id')->toArray());

        return view('host.schedules.index', $viewData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateSchedule $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSchedule $request)
    {
        $this->scheduleRepository->createSchedule($request->validated());

        return redirect()->back()->with('success', 'Tạo lịch thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateSchedule $request
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSchedule $request, Schedule $schedule)
    {
        $this->scheduleRepository->updateSchedule($request->validated(), $schedule->id);

        return redirect()->back()->with('success', 'Cập nhật lịch thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return redirect()->back()->with('success', 'Xóa lịch thành công');
    }

    /**
     * Get schedules of tour
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tour $tour
     * @return ScheduleCollection
     */
    public function getTourSchedules(Request $request, Tour $tour)
    {
        return new ScheduleCollection($this->scheduleRepository->getTourSchedules($request->all(), $tour->id));
    }
}
