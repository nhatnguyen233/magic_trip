<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\CreateCart;
use App\Http\Requests\Cart\UpdateCart;
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
        $number_of_slots = array_sum($carts->pluck('number_of_slots')->toArray()); // Tổng số lượng

        return view('customer.cart.index',compact('carts','total_price_all', 'number_of_slots'));
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
        $this->cartRepository->addToCart($request->validated());

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
     * @param  UpdateCart $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCart $request, Cart $cart)
    {
        if($request->number_of_slots <= 0)
        {
            $cart->delete();
        }

        $cart->update([
            'adults' => $request->adults,
            'childrens' => $request->childrens,
            'number_of_slots' => $request->number_of_slots,
            'total_price' => $request->number_of_slots * $cart->price,
        ]);

        return redirect()->back()->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();
        \session()->put('total_item_cart', $this->cartRepository->findWhere(['session_token' => \session()->get('session_token')])->count());

        return redirect()->back()->with('success', 'Xóa thành công');
    }

    /**
     * Remove all elements of cart
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteAllCart()
    {
        $this->cartRepository->deleteAllCart(\session()->get('session_token'));
        \session()->put('total_item_cart',$this->cartRepository->findWhere(['session_token' => \session()->get('session_token')])->count());

        return redirect()->back()->with('success', 'Đã xóa hết');
    }
}
