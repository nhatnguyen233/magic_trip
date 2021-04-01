<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\AuthController as BaseAuthController;
use App\Repositories\Payment\PaymentRepository;
use Illuminate\Http\Request;
use App\Repositories\Province\ProvinceRepository;
use App\Repositories\User\UserRepository;

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
        if ($this->userRepository->createUserInfo($request->except(['_token'])) && $this->paymentRepository->createPaymentInfo($request->except(['_token']))) {
            return redirect()->route('customer.home')->with('success', __('messages.create_success'));
        }

        return redirect()->back()->with('error', __('messages.create_fail'));
    }

}
