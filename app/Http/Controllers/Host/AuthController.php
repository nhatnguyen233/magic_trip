<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\AuthController as BaseAuthController;
use App\Http\Requests\Host\Register;
use App\Repositories\Host\HostRepository;
use App\Repositories\Province\ProvinceRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseAuthController
{
    protected $service;
    protected $userRepository;
    protected $hostRepository;
    protected $provinceRepository;

    protected $redirectTo = 'host';

    public function __construct(
        ProvinceRepository $provinceRepository,
        UserRepository $userRepository,
        HostRepository $hostRepository
    )
    {
        $this->guardName = 'host';
        $this->provinceRepository = $provinceRepository;
        $this->userRepository = $userRepository;
        $this->hostRepository = $hostRepository;

        parent::__construct();
    }

    public function showRegisterForm()
    {
        $viewData['provinces'] = $this->provinceRepository->all();

        return view('host.register', $viewData);
    }

    public function register(Register $request)
    {
        $user = $this->userRepository->createUserInfo($request->validated());
        $this->hostRepository->createHost($request->validated(), $user->id);
        Auth::guard('host')->login($user);

        return redirect(url('/host'))->with('user', $user);
    }
}
