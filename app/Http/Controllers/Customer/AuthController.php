<?php

namespace App\Http\Controllers\Customer;

use App\Enums\UserRole;
use App\Http\Controllers\AuthController as BaseAuthController;
use App\Services\Customers\UserService;
use Illuminate\Http\Request;

class AuthController extends BaseAuthController
{
    protected $service;
    protected $redirectTo = '/';
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->guardName = 'customer';
        parent::__construct();
        $this->userService = $this->userService;

    }

    public function showRegisterForm()
    {
        return view('customer.register');
    }

    public function registerCustomers(Request $request)
    {
        $userInfo = $request;
        $userInfo['name'] = $request['firstname_booking'] + $request['lastname_booking'];
        $userInfo['email'] = $request['email_booking'];
        $userInfo['role_id'] = UserRole::CUSTOMER;
        $userInfo['phone'] = $request['telephone_booking'];

        $user = $this->userService->create($userInfo);

        return $user->get();
 
        if ($user) {
            return redirect()->route('shipping-addresses.index')->with('success', '追加しました。');
        }
 
         return redirect()->back()->with('fail', 'エラーが発生しました。');
    }

}
