<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\AuthController as BaseAuthController;
use Illuminate\Http\Request;

class AuthController extends BaseAuthController
{
    protected $service;
    protected $redirectTo = 'staff/home';

    public function __construct()
    {
        $this->guardName = 'staff';
        parent::__construct();
    }
}
