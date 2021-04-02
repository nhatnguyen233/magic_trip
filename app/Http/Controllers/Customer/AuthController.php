<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\AuthController as BaseAuthController;
use App\Http\Requests\User\Register;
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
        $viewData['provinces'] = $this->provinceRepository->all();

        return view('customer.register', $viewData);
    }

    public function registerCustomers(Register $request)
    {
        $customer = $this->userRepository->createUserInfo($request->validated());
        Auth::guard('customer')->login($customer);

        return redirect(url('/'))->with('customer', $customer);
    }

}
