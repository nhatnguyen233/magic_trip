<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tour\GetList;
use App\Models\Tour;
use App\Repositories\Province\ProvinceRepository;
use App\Repositories\Review\ReviewRepository;
use App\Repositories\Tour\TourRepository;
use App\Support\Collection;
use Illuminate\Http\Request;

class TourController extends Controller
{
    protected $reviewRepository;
    protected $tourRepository;
    protected $provinceRepository;

    public function __construct(
        ReviewRepository $reviewRepository,
        TourRepository $tourRepository,
        ProvinceRepository $provinceRepository
    )
    {
        $this->reviewRepository = $reviewRepository;
        $this->tourRepository = $tourRepository;
        $this->provinceRepository = $provinceRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  GetList $request
     * @return \Illuminate\Http\Response
     */
    public function index(GetList $request)
    {
        $viewData['tours'] = (new Collection($this->tourRepository->getList($request->validated())->sortByDesc('created_at')))->paginate(5);
        $viewData['provinces'] = $this->provinceRepository->all();

        return view('customer.tours.index', $viewData);
    }

    /**
     * Display a grid of tours.
     *
     * @param  GetList $request
     * @return \Illuminate\Http\Response
     */
    public function getGridTours(GetList $request)
    {
        $viewData['tours'] = (new Collection($this->tourRepository->getList($request->validated())->sortByDesc('created_at')))->paginate(9);
        $viewData['provinces'] = $this->provinceRepository->all();

        return view('customer.tours.tour-grid', $viewData);
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
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function show(Tour $tour)
    {
        $viewData['tour'] = $tour;
        $viewData['reviews'] = $this->reviewRepository->findWhere(['tour_id' => $tour->id]);

        if($viewData['reviews']->count() > 0)
        {
            $viewData['average'] = round(array_sum($viewData['reviews']->pluck('rate')->toArray())/$viewData['reviews']->count(),1);
        } else {
            $viewData['average'] = 0;
        }

        return view('customer.tours.tour-detail', $viewData);
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
