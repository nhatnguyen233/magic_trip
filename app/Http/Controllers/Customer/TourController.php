<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Review\ReviewRepository;
use App\Repositories\Tour\TourRepository;
use Illuminate\Http\Request;

class TourController extends Controller
{
    protected $reviewRepository;
    protected $tourRepository;
    protected $categoryRepository;

    public function __construct(ReviewRepository $reviewRepository, TourRepository $tourRepository, CategoryRepository $categoryRepository)
    {
        $this->reviewRepository = $reviewRepository;
        $this->tourRepository = $tourRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $viewData['tours'] = $this->tourRepository->paginate(5);

        return view('customer.tours.index', $viewData);
    }

    /**
     * Display a grid of tours.
     *
     * @return \Illuminate\Http\Response
     */
    public function getGridTours()
    {
        $viewData['tours'] = $this->tourRepository->paginate(9);
        $viewData['categoryNames'] = $this->categoryRepository->getCategoryTourismName();

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
        $reviews = $this->reviewRepository->findWhere(['tour_id' => $tour->id]);

        if($reviews->count() > 0)
        {
            $average = round(array_sum($reviews->pluck('rate')->toArray())/$reviews->count(),1);
        } else {
            $average = 0;
        }

        return view('customer.tours.tour-detail', compact('tour', 'reviews', 'average'));
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
