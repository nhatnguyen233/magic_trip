<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Accommodation;
use App\Models\Tour;
use App\Repositories\Accommodation\AccommodationRepository;
use Illuminate\Http\Request;

class AccommodationController extends Controller
{
    protected $accommodationRepository;

    public function __construct(AccommodationRepository $accommodationRepository)
    {
        $this->accommodationRepository = $accommodationRepository;
    }

    public function index()
    {
        $viewData['accommodations'] = $this->accommodationRepository->all();

        return view('customer.accommodations.index', $viewData);
    }

    public function show(Accommodation $accommodation)
    {
        $viewData['accommodation'] = $accommodation;

        return view('customer.accommodations.accommodation-detail', $viewData);
    }

}
