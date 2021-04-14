<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;
use App\Repositories\Review\ReviewRepository;
use App\Repositories\Tour\TourRepository;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    protected $reviewRepository;
    protected $tourRepository;

    public function __construct(
        ReviewRepository $reviewRepository,
        TourRepository $tourRepository
    )
    {
        $this->reviewRepository = $reviewRepository;
        $this->tourRepository = $tourRepository;
    }

    public function index(Request $request)
    {
        $filters = $request->all();

        $viewData['reviews'] = $this->reviewRepository->getList(Auth('host')->id(), $filters);
        $viewData['filters'] = $request->all();
        $viewData['tourNames'] = ['ALL' => 'ALL'] + $this->tourRepository->getTourName();

        return view('host.reviews.index', $viewData);
    }

}
