<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Repositories\Host\HostRepository;
use App\Http\Requests\Host\Register;
use App\Models\Host;
use App\Models\User;
use App\Repositories\Province\ProvinceRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class HostController extends Controller
{
    protected $hostRepository;
    protected $userRepository;
    protected $provinceRepository;

    public function __construct(HostRepository $hostRepository, UserRepository $userRepository, ProvinceRepository $provinceRepository)
    {
        $this->hostRepository = $hostRepository;
        $this->userRepository = $userRepository;
        $this->provinceRepository = $provinceRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $viewData['hosts'] = $this->userRepository->findWhere(['role_id' => UserRole::HOST]);

        $viewData['hosts'] = $this->hostRepository->all();

        return view('admin.hosts.index', $viewData);
    }

    public function create()
    {
        $viewData['provinces'] = $this->provinceRepository->all();

        return view('admin.hosts.create', $viewData);
    }

    public function store(Register $request)
    {
        $user = $this->userRepository->createUserInfo($request->except(['_token']));

        if($this->hostRepository->createHost($request->validated(), $user->id)) {
            return redirect()->route('admin.hosts.index')->with('success', __('message.create_success'));
        }
    }

    public function edit(Host $host)
    {
        $viewData['provinces'] = $this->provinceRepository->all();

        $viewData['host'] =  $host;

        return view('admin.hosts.edit',  $viewData);
    }

    public function update(Request $request)
    {
        if ($this->hostRepository->updateBaseInfo($request->except(['_token']), $request->host)) {
            return redirect()->route('admin.hosts.index')->with('success', __('message.update_success'));
        }
    }

    public function destroy(Host $host)
    {
        if($this->hostRepository->deleteHost($host)){

            return redirect()->back()->with('success', __('message.update_success'));
        }

        return redirect()->back()->with('fail', __('message.update_fail'));
    }

}
