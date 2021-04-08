<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;
use App\Http\Requests\TourInfo\CreateTourInfo as Create;
use App\Models\TourInfo;
use App\Models\Tour;
use App\Repositories\Accommodation\AccommodationRepository;
use App\Repositories\Attraction\AttractionRepository;
use App\Repositories\Tour\TourRepository;
use App\Repositories\TourInfo\TourInfoRepository;
use Illuminate\Http\Request;

class TourInfoController extends Controller
{
    protected $tourInfoRepository;
    protected $tourRepository;
    protected $attractionRepository;
    protected $accommodationRepository;

    public function __construct(
        TourRepository $tourRepository,
        TourInfoRepository $tourInfoRepository,
        AttractionRepository $attractionRepository,
        AccommodationRepository $accommodationRepository
    )
    {
        $this->tourRepository = $tourRepository;
        $this->tourInfoRepository = $tourInfoRepository;
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
        $infos = $this->tourInfoRepository->all();
        $accommodations = $this->accommodationRepository->all();
        $attractions = $this->attractionRepository->all();

        return view('host.tours.infos.index', compact('infos', 'tours', 'attractions', 'accommodations'));
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

        return view('host.tours.infos.create', compact('accommodations', 'attractions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Create $request
     * @return \Illuminate\Http\Response
     */
    public function store(Create $request)
    {
        $tourInfo = $this->tourInfoRepository->createTourInfo($request->validated());

        return response()->json([
            'tourInfo' => $tourInfo,
            'success' => 'Thêm địa điểm tham quan thành công'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\TourInfo $tourInfo
     * @return \Illuminate\Http\Response
     */
    public function show(TourInfo $tourInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\TourInfo $tourInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(TourInfo $tourInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TourInfo $tourInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TourInfo $tourInfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\TourInfo $tourInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(TourInfo $tourInfo)
    {
        //
    }

    /**
     * Display a listing info of tour of the resource.
     * @param Tour $tour
     * @return \Illuminate\Http\Response
     */
    public function getListTourInfo(Tour $tour)
    {
        $tours = $this->tourRepository->all();
        $infos = $this->tourInfoRepository->findWhere(['tour_id' => $tour->id]);
        $accommodations = $this->accommodationRepository->all();
        $attractions = $this->attractionRepository->all();

        return view('host.tours.infos.list', compact('infos', 'tours', 'attractions', 'accommodations'));
    }
}
