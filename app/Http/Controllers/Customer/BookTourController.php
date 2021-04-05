<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\BookTour;
use App\Repositories\BookTour\BookTourRepository;
use App\Repositories\Cart\CartRepository;
use App\Repositories\Province\ProvinceRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BookTourController extends Controller
{
    protected $cartRepository;
    protected $provinceRepository;
    protected $bookTourRepository;

    public function __construct(
        CartRepository $cartRepository,
        ProvinceRepository $provinceRepository,
        BookTourRepository $bookTourRepository
    )
    {
        $this->cartRepository = $cartRepository;
        $this->provinceRepository = $provinceRepository;
        $this->bookTourRepository = $bookTourRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['provinces'] = $this->provinceRepository->all();
        $data['carts'] = $this->cartRepository->findWhere(['session_token' => session()->get('session_token')]);
        $data['total_price_all'] = array_sum($data['carts']->pluck('total_price')->toArray()); // Tổng số tiền các đơn trong giỏ
        $data['total_quantity'] = array_sum($data['carts']->pluck('quantity')->toArray()); // Tổng số lượng
        $data['start_time_min'] = $data['carts']->filter(function ($item) {
            return $item->start_time != null;
        })->min('start_time');  // Thời điểm bắt đầu sớm nhất trong list giỏ
        $data['end_time_max'] = $data['carts']->filter(function ($item) {
            return $item->end_time != null;
        })->max('end_time'); // Thời điểm kết thục bắt đầu muộn nhất trong list giỏ

        return view('customer.book_tour.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $carts = $this->cartRepository->findWhere(['session_token' => session()->get('session_token')]);
        $books = $this->bookTourRepository->createBookTour(auth('customer')->id(), $request->type, $carts->toArray());
        if($books != null) {
            $this->cartRepository->deleteAllCart(session()->get('session_token'));
            Session::forget(['session_token', 'total_item_cart']);
        }

        return response()->json(['data' => $books]);
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

    /**
     * Display the finished order page.
     *
     * @return \Illuminate\Http\Response
     */

    public function getFinishedOrderPage()
    {
        return view('customer.book_tour.finished');
    }
}
