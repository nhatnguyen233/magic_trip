<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;
use App\Models\BookTour;
use App\Support\Collection;
use App\Repositories\BookTour\BookTourRepository;
use Illuminate\Http\Request;

class BookTourController extends Controller
{
    protected $bookRepository;

    public function __construct(BookTourRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $viewData['bookings'] = (new Collection($this->bookRepository->getBookTourByHostID(auth('host')->user()->host->id,$request->all())))->paginate(3);
        $viewData['book_status_names'] = ['all' => 'Tất cả'] + config('bookings.status');

        return view('host.bookings.index', $viewData);
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
     * @param  \App\Models\BookTour  $bookTour
     * @return \Illuminate\Http\Response
     */
    public function show(BookTour $bookTour)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BookTour  $bookTour
     * @return \Illuminate\Http\Response
     */
    public function edit(BookTour $bookTour)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BookTour  $bookTour
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BookTour $bookTour)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BookTour  $bookTour
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookTour $bookTour)
    {
        //
    }
}
