<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\AuthController as BaseAuthController;
use Illuminate\Http\Request;

class AuthController extends BaseAuthController
{
    protected $service;
    protected $redirectTo = 'home';

    public function __construct()
    {
        $this->guardName = 'guest';
        parent::__construct();
    }
}
