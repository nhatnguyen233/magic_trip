<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;
use App\Models\Host;
use App\Repositories\BookTour\BookTourRepository;
use App\Repositories\Review\ReviewRepository;
use App\Repositories\Tour\TourRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $tourRepository;
    protected $bookRepository;
    protected $reviewRepository;

    public function __construct(
        TourRepository $tourRepository,
        BookTourRepository $bookRepository,
        ReviewRepository $reviewRepository
    )
    {
        $this->tourRepository = $tourRepository;
        $this->bookRepository = $bookRepository;
        $this->reviewRepository = $reviewRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $viewData['tours'] = $this->tourRepository->findWhere(['user_id'=>auth('host')->id()]);
        $viewData['bookings'] = $this->bookRepository->getBookTourByHostID(auth('host')->user()->host->id,$request->all());
        $viewData['reviews'] = $this->reviewRepository->findWhereIn('tour_id', $viewData['tours']->pluck('id')->toArray());

        return view('host.home', $viewData);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Host  $host
     * @return \Illuminate\Http\Response
     */
    public function show(Host $host)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Host  $host
     * @return \Illuminate\Http\Response
     */
    public function edit(Host $host)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Host  $host
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Host $host)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Host  $host
     * @return \Illuminate\Http\Response
     */
    public function destroy(Host $host)
    {
        //
    }
}
