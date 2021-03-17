<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Repositories\Accommodation\AccommodationRepository;
use App\Repositories\Attraction\AttractionRepository;
use App\Repositories\Tour\TourRepository;
use Illuminate\Http\Request;

class TourController extends Controller
{
    protected $tourRepository;
    protected $attractionRepository;
    protected $accommodationRepository;

    public function __construct(
        TourRepository $tourRepository,
        AttractionRepository $attractionRepository,
        AccommodationRepository $accommodationRepository
    )
    {
        $this->tourRepository = $tourRepository;
        $this->attractionRepository = $attractionRepository;
        $this->accommodationRepository = $accommodationRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tours = $this->tourRepository->all();

        return view('host.tours.index', compact('tours'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $accommodations = $this->accommodationRepository->all();
        $attractions = $this->attractionRepository->all();

        return view('host.tours.create', compact('accommodations', 'attractions'));
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
    public function edit(Tour $tour)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tour $tour)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tour $tour)
    {
        //
    }
}