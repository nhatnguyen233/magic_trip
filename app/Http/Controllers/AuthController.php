<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Enums\UserRole;
use Illuminate\Support\Facades\URL;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    protected $guardName;
    protected $redirectTo;

    public function __construct()
    {
        $this->middleware('auth.' . $this->guardName)->except([
            'showLoginForm',
            'showRegisterForm',
            'login',
            'create',
            'redirectToProvider',
            'registerCustomers',
            'updateProfileView',
            'updateProfileUser'
        ]);

        $this->middleware('guest:' . $this->guardName)->except([
            'logout',
            'store'
        ]);
    }

    public function guard()
    {
        return Auth::guard($this->guardName);
    }

    protected function getRoleByGuard()
    {
        $roles = Role::pluck('id', 'name')->toArray();

        switch ($this->guardName) {
            case 'customer':
                return $roles[Role::CUSTOMER] ?? UserRole::CUSTOMER;
            case 'host':
                return $roles[Role::HOST] ?? UserRole::HOST;
            case 'admin':
                return $roles[Role::ADMINISTRATOR] ?? UserRole::ADMINISTRATOR;
            default:
                return '';
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
//        $credentials['is_active'] = true;
        $credentials['role_id'] = $this->getRoleByGuard();

        if ($this->guard()->attempt($credentials, $request->filled('remember'))) {
            return redirect()->intended(URL::previous());
        }

        return $this->sendFailedLoginResponse($request);
    }

    public function showLoginForm()
    {
        return view($this->guardName . '.login');
    }

    public function me()
    {
        return $this->guard()->user();
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        if($this->guardName == 'customer') {
            return redirect(URL::previous());
        }

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $request->session()->flush();

        return redirect(route($this->guardName . '.login'));
    }

    public function redirectToProvider()
    {
        $user = auth()->guard($this->guardName)->user();
        $this->guard()->login($user);

        return redirect()->to(route($this->guardName . '.home'));
    }
}
