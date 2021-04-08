<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Repositories\Accommodation\AccommodationRepository;
use App\Repositories\Attraction\AttractionRepository;
use App\Repositories\Tour\TourRepository;
use App\Http\Requests\Tour\CreateTour as Create;
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
        $tours = $this->tourRepository->findWhere(['user_id'=>auth('host')->id()]);

        return view('host.tours.index', compact('tours'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tours = $this->tourRepository->all();
        $accommodations = $this->accommodationRepository->all();
        $attractions = $this->attractionRepository->all();

        return view('host.tours.create', compact('tours','accommodations', 'attractions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Create  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Create $request)
    {
        $tour = $this->tourRepository->createGeneralTour($request->validated());

        return redirect()->route('host.tour-infos.list', $tour->id)->with('tour', $tour);
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
        $tours = $this->tourRepository->all();
        $accommodations = $this->accommodationRepository->all();
        $attractions = $this->attractionRepository->all();

        return view('host.tours.edit', compact('tours', 'accommodations', 'attractions', 'tour'));
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
