<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;
use App\Http\Requests\Event\EventRequest;
use App\Models\Tour;
use App\Http\Requests\Tour\CreateTour as Create;
use App\Models\Event;
use App\Repositories\Event\EventRepository;
use Illuminate\Http\Request;

class EventController extends Controller
{
    protected $eventRepository;

    public function __construct(
        EventRepository $eventRepository,
    )
    {
        $this->eventRepository = $eventRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $viewData['events'] = $this->eventRepository->findWhere(['user_id'=>auth('host')->id()]);

        return view('host.news.index',$viewData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('host.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Create  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {
        $viewData['event'] = $this->eventRepository->createEvent($request->all());

        return redirect()->route('host.news.index')->with('success', 'Create new successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function show(Tour $tour)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        $viewData['event'] = $event;

        return view('host.news.edit', $viewData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $this->eventRepository->updateEvent($request->all(), $event->id);

        return redirect()->route('host.news.index')->with('success', 'Update new successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        if($this->eventRepository->removeEvent($event)){

            return redirect()->back()->with('success', __('message.update_success'));
        }

        return redirect()->back()->with('fail', __('message.update_fail'));
    }
}
