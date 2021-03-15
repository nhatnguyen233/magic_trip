<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\AuthController as BaseAuthController;
use Illuminate\Http\Request;

class AuthController extends BaseAuthController
{
    protected $service;
    protected $redirectTo = 'host/home';

    public function __construct()
    {
        $this->guardName = 'host';
        parent::__construct();
    }
}
