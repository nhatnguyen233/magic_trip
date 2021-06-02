<?php

namespace App\Http\Controllers;

use App\Enums\CatType;
use App\Repositories\Accommodation\AccommodationRepository;
use App\Repositories\Attraction\AttractionRepository;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Tour\TourRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $tourRepository;
    protected $attractionRepository;
    protected $accommodationRepository;
    protected $categoryRepository;

    public function __construct(
        TourRepository $tourRepository,
        AttractionRepository $attractionRepository,
        AccommodationRepository $accommodationRepository,
        CategoryRepository $categoryRepository
    )
    {
        $this->tourRepository = $tourRepository;
        $this->attractionRepository = $attractionRepository;
        $this->accommodationRepository = $accommodationRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $viewData['accommodations'] = $this->accommodationRepository->all()->random(4);
        $viewData['total_accommodations'] = $this->accommodationRepository->all()->count();
        $viewData['attractions'] = $this->attractionRepository->all()->random(4);
        $viewData['total_attractions'] = $this->attractionRepository->all()->count();
        $viewData['tours'] = $this->tourRepository->all()->sortByDesc('created_at');
        $viewData['categories'] = $this->categoryRepository->findWhere(['type' => CatType::TOURISM]);

        return view('home', $viewData);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
