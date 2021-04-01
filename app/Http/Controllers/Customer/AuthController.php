<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\AuthController as BaseAuthController;
use Illuminate\Http\Request;

class AuthController extends BaseAuthController
{
    protected $service;
    protected $redirectTo = '/';

    public function __construct()
    {
        $this->guardName = 'customer';
        parent::__construct();
    }

    public function showRegisterForm()
    {
        return view('customer.register');
    }
}
