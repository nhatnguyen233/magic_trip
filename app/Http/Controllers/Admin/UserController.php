<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Register;
use App\Http\Requests\User\UpdateProfile;
use App\Models\User;
use App\Repositories\Province\ProvinceRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userRepository;
    protected $provinceRepository;

    public function __construct(UserRepository $userRepository, ProvinceRepository $provinceRepository)
    {
        $this->userRepository = $userRepository;
        $this->provinceRepository = $provinceRepository;
    }

    public function index()
    {
        $viewData['listUsers'] = $this->userRepository->getList(UserRole::CUSTOMER);

        return view('admin.users.index', $viewData);
    }

    public function create()
    {
        $viewData['provinces'] = $this->provinceRepository->all();

        return view('admin.users.create', $viewData);
    }

    public function store(Register $request)
    {
        if($this->userRepository->createUserInfo($request->except(['_token']))) {
            return redirect()->route('admin.users.index')->with('success', __('message.create_success'));
        }

        return redirect()->back()->with('fail', __('message.update_fail'));
    }

    public function edit(User $user)
    {
        $viewData['provinces'] = $this->provinceRepository->all();
        $viewData['user'] =  $user;

        return view('admin.users.edit',  $viewData);
    }

    public function update(UpdateProfile $request)
    {
        if ($this->userRepository->updateBaseInfo($request->validated(), $request->user)) {
            return redirect()->route('admin.users.index')->with('success', __('message.update_success'));
        }

        return redirect()->back()->with('fail', __('message.update_fail'));
    }

    public function destroy(User $user)
    {
        if($this->userRepository->deleteUser($user)){

            return redirect()->back()->with('success', __('message.update_success'));
        }

        return redirect()->back()->with('fail', __('message.update_fail'));
    }

}
