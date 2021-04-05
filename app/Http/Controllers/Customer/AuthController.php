<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\AuthController as BaseAuthController;
use App\Http\Requests\User\Register;
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

    public function __construct(UserRepository $userRepository, ProvinceRepository $provinceRepository)
    {
        $this->guardName = 'customer';
        parent::__construct();
        $this->userRepository = $userRepository;
        $this->provinceRepository = $provinceRepository;
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

    public function updateProfileView()
    {
        $viewData['provinces'] = $this->provinceRepository->all();
        $viewData['user'] =  $this->userRepository->getUserLoginWithRelation();

        return view('customer.update-profile', $viewData);
    }

    public function updateProfileUser(Request $request)
    {
        if ($this->userRepository->updateBaseInfo($request->except(['_token']), \auth('customer')->id())) {
            return redirect()->back()->with('success', __('messages.update_success'));
        }

        return redirect()->back()->with('fail', __('messages.update_fail'));
    }

}
