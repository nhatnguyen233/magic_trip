<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AuthController as BaseAuthController;
use Illuminate\Http\Request;

class AuthController extends BaseAuthController
{
    protected $redirectTo = 'admincp';

    public function __construct()
    {
        $this->guardName = 'admin';
        parent::__construct();
    }
}
