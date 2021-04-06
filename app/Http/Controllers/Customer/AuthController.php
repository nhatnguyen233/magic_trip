<?php

namespace App\Http\Controllers\Customer;

use App\Enums\UserRole;
use App\Http\Controllers\AuthController as BaseAuthController;
use App\Http\Requests\User\Register;
use App\Models\User;
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
        $customer = $this->userRepository->createUserInfo($request->except(['_token']));

        if($customer->role_id == UserRole::CUSTOMER) {
            Auth::guard('customer')->login($customer);

            return redirect(url('/'))->with('customer', $customer);
        } elseif($customer->role_id == UserRole::HOST) {
            return redirect()->back()->with('success', __('message.register_host'));
        }
    }

    public function updateProfileView(User $user)
    {
        $viewData['provinces'] = $this->provinceRepository->all();
        $viewData['user'] =  $user;

        return view('customer.update-profile', $viewData);
    }

    public function updateProfileUser(Request $request)
    {
        if ($this->userRepository->updateBaseInfo($request->except(['_token']), \auth('customer')->id())) {
            return redirect()->back()->with('success', __('messages.update_success'));
        }

        return redirect()->back()->with('fail', __('message.update_fail'));
    }

}
