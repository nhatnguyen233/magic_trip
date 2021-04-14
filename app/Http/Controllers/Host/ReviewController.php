<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;
use App\Repositories\Review\ReviewRepository;

class ReviewController extends Controller
{
    protected $reviewRepository;

    public function __construct(
        ReviewRepository $reviewRepository
    )
    {
        $this->reviewRepository = $reviewRepository;
    }

    public function index()
    {
        $viewData['reviews'] = $this->reviewRepository->getList(Auth('host')->id());

        return view('host.reviews.index', $viewData);
    }

}
