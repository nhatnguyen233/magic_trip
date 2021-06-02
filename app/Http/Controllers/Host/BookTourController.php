<?php

namespace App\Http\Controllers\Host;

use App\Enums\BookingStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookTour\Approve;
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
        $viewData['bookings'] = (new Collection($this->bookRepository->getBookTourByHostID(auth('host')->user()->host->id,$request->all())))->sortByDesc('created_at')->paginate(3);
        $viewData['book_status_names'] = ['' => 'Tất cả'] + config('bookings.status');

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
     * @param  \App\Models\BookTour  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(BookTour $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BookTour  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(BookTour $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BookTour  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BookTour $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BookTour  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookTour $booking)
    {
        //
    }

    /**
     * Approve bookings resource from storage.
     *
     * @param  Approve $request
     * @param  \App\Models\BookTour $booking
     * @return \Illuminate\Http\Response
     */
    public function approve(Approve $request, BookTour $booking)
    {
        $booking->update(['status' => BookingStatus::APPROVED]);

        return redirect()->back()->with('success', 'Chấp thuận lịch đặt thành công');
    }

    /**
     * Approve bookings resource from storage.
     *
     * @param  Request $request
     * @param  \App\Models\BookTour $booking
     * @return \Illuminate\Http\Response
     */
    public function cancel(Request $request, BookTour $booking)
    {
        $booking->update(['status' => BookingStatus::PENDING]);

        return redirect()->back()->with('success', 'Hủy chấp nhận lịch đặt thành công');
    }

    /**
     * Finished confirm bookings resource from storage.
     *
     * @param  Request $request
     * @param  \App\Models\BookTour $booking
     * @return \Illuminate\Http\Response
     */
    public function finishedConfirm(Request $request, BookTour $booking)
    {
        $booking->update(['status' => BookingStatus::FINISHED]);

        return redirect()->back()->with('success', 'Xác nhận hoàn thành');
    }
}
