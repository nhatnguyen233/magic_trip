<?php

namespace App\Http\Controllers\Admin;

use App\Enums\StatusHost;
use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Register;
use App\Models\User;
use App\Repositories\Province\ProvinceRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;

class HostController extends Controller
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
        $viewData['listHost'] = $this->userRepository->getList(UserRole::HOST, StatusHost::APPROVE);

        return view('admin.host.index', $viewData);
    }

    public function create()
    {
        $viewData['provinces'] = $this->provinceRepository->all();

        return view('admin.host.create', $viewData);
    }

    public function indexUnpproveHost()
    {
        $viewData['listUnpproveHost'] = $this->userRepository->getList(UserRole::HOST, StatusHost::UNAPPROVE);

        return view('admin.host.index-unpprove', $viewData);
    }

    public function store(Register $request)
    {
        if($this->userRepository->createUserInfo($request->except(['_token']))) {
            return redirect()->route('admin.host.index')->with('success', __('message.update_success'));
        }
    }

    public function edit(User $host)
    {
        $viewData['provinces'] = $this->provinceRepository->all();
        $viewData['host'] =  $host;

        return view('admin.host.edit',  $viewData);
    }

    public function update(Request $request)
    {
        if ($this->userRepository->updateBaseInfo($request->except(['_token']), $request->host)) {
            return redirect()->route('admin.host.index')->with('success', __('message.update_success'));
        }
    }

    public function destroy(User $host)
    {
        if($this->userRepository->deleteUser($host)){

            return redirect()->back()->with('success', __('message.update_success'));
        }

        return redirect()->back()->with('fail', __('message.update_fail'));
    }

    public function updateApproveStatus(User $host)
    {
        $this->userRepository->approveStatusHost($host);

        return redirect()->back()->with('success', __('message.update_success'));
    }

}
