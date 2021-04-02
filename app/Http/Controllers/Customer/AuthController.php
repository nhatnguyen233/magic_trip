<?php

namespace App\Http\Controllers\Customer;

use App\Enums\UserRole;
use App\Http\Controllers\AuthController as BaseAuthController;
use App\Models\User;
use App\Repositories\Payment\PaymentRepository;
use Illuminate\Http\Request;
use App\Repositories\Province\ProvinceRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseAuthController
{
    protected $service;
    protected $redirectTo = '/';
    protected $userRepository;
    protected $provinceRepository;
    protected $paymentRepository;

    public function __construct(UserRepository $userRepository, ProvinceRepository $provinceRepository, PaymentRepository $paymentRepository)
    {
        $this->guardName = 'customer';
        parent::__construct();
        $this->userRepository = $userRepository;
        $this->provinceRepository = $provinceRepository;
        $this->paymentRepository = $paymentRepository;
    }

    public function showRegisterForm()
    {
        $this->viewData['provinces'] = $this->provinceRepository->all();

        return view('customer.register', $this->viewData);
    }

    public function registerCustomers(Request $request)
    {
        $createPaymentInfo = $this->paymentRepository->createPaymentInfo($request->except(['_token']));

        $createUserInfo = $this->userRepository->createUserInfo([
            'name' => $request['firstname'] . '' .$request['lastname'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'role_id' => UserRole::CUSTOMER,
            'password' => $request['password'],
            'payment_id' => $createPaymentInfo->id,
        ]);

        if($createUserInfo) {
            return redirect()->route('customer.home')->with('success', __('messages.create_success'));

        }

        return redirect()->back()->with('error', __('messages.create_fail'));
    }

}
