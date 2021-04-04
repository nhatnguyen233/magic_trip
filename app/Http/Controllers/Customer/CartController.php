<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\CreateCart;
use App\Models\Cart;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    protected $cartRepository;

    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carts = $this->cartRepository->findWhere(['session_token' => session()->get('session_token')]);
        $total_price_all = array_sum($carts->pluck('total_price')->toArray()); // Tổng số tiền các đơn trong giỏ
        $total_quantity = array_sum($carts->pluck('quantity')->toArray()); // Tổng số lượng
        $start_time_min = $carts->filter(function ($item) {
            return $item->start_time != null;
        })->min('start_time');  // Thời điểm bắt đầu sớm nhất trong list giỏ
        $end_time_max = $carts->filter(function ($item) {
            return $item->end_time != null;
        })->max('end_time'); // Thời điểm kết thục bắt đầu muộn nhất trong list giỏ

        return view('customer.cart.index',compact('carts','total_price_all', 'start_time_min','end_time_max', 'total_quantity'));
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
     * @param  CreateCart $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCart $request)
    {
        $cart = $this->cartRepository->findWhere(['session_token' => \session()->get('session_token')]);
        $this->cartRepository->addToCart($request->validated());
        Session::put('total_item_cart', array_sum($cart->pluck('quantity')->toArray()) +1);

        return redirect(route('cart.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
