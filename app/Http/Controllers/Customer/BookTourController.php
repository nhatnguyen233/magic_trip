<?php

namespace App\Http\Controllers\Customer;

use App\Enums\BookingStatus;
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
        $viewData['orders'] = $this->bookTourRepository
                                ->where('user_id', auth('customer')->id())
                                ->orderBy('created_at', 'desc')
                                ->paginate(20);
        $viewData['total_price_all'] = array_sum($viewData['orders']->where('status', '>=', BookingStatus::APPROVED)->where('status', '<>', BookingStatus::CANCELED)->pluck('total_price')->toArray()); // Tổng số tiền
        $viewData['number_of_slots'] = array_sum($viewData['orders']->where('status', '>=', BookingStatus::APPROVED)->where('status', '<>', BookingStatus::CANCELED)->pluck('number_of_slots')->toArray()); // Tổng số lượng

        return view('customer.book_tour.index', $viewData);
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
        $data['number_of_slots'] = array_sum($data['carts']->pluck('number_of_slots')->toArray()); // Tổng số lượng

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
        if($bookTour->status != BookingStatus::APPROVED || $bookTour->status != BookingStatus::PAID)
        {
            if($bookTour->bills != null)
            {
                $bookTour->bills()->delete();
            }
            $bookTour->delete();
        }

        return redirect()->back()->with('success', 'Xóa thành công');
    }

    /**
     * Display the finished order page.
     *
     * @return \Illuminate\Http\Response
     */

    public function getPendingOrderPage()
    {
        $viewData['orders'] = $this->bookTourRepository
            ->where('user_id', auth('customer')->id())
            ->whereIn('status', [BookingStatus::PENDING, BookingStatus::APPROVED, BookingStatus::CANCELED])
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        $viewData['total_price_all'] = array_sum($viewData['orders']->where('status', '>=', BookingStatus::APPROVED)->pluck('total_price')->toArray()); // Tổng số tiền các đơn trong giỏ
        $viewData['number_of_slots'] = array_sum($viewData['orders']->where('status', '>=', BookingStatus::APPROVED)->pluck('number_of_slots')->toArray()); // Tổng số lượng

        return view('customer.book_tour.pending', $viewData);
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

    /**
     * Display the payment order page.
     *
     * @return \Illuminate\Http\Response
     */

    public function getPaymentOrderPage()
    {
        $viewData['orders'] = $this->bookTourRepository
                            ->where('user_id', auth('customer')->id())
                            ->where('status', 1)
                            ->paginate(20);
        $viewData['total_price_all'] = array_sum($viewData['orders']->pluck('total_price')->toArray()); // Tổng số tiền các đơn trong giỏ
        $viewData['number_of_slots'] = array_sum($viewData['orders']->pluck('number_of_slots')->toArray()); // Tổng số lượng

        return view('customer.book_tour.payment', $viewData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BookTour  $booking
     * @return \Illuminate\Http\Response
     */
    public function paymentBooking(Request $request)
    {
        $this->bookTourRepository->payment(auth('customer')->id());

        return redirect(url('/book-tour/order-finished'));
    }
}
