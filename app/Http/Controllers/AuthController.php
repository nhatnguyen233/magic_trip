<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Enums\UserRole;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    protected $guardName;
    protected $redirectTo;

    public function __construct()
    {
        $this->middleware('auth.' . $this->guardName);
    }

    public function guard()
    {
        return Auth::guard($this->guardName);
    }

    protected function getRoleByGuard()
    {
        $roles = Role::pluck('id', 'name')->toArray();

        switch ($this->guardName) {
            case 'guest':
                return $roles[Role::GUEST] ?? UserRole::GUEST;
            case 'staff':
                return $roles[Role::STAFF] ?? UserRole::STAFF;
            case 'admin':
                return $roles[Role::ADMINISTRATOR] ?? UserRole::ADMINISTRATOR;
            default:
                return '';
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $credentials['is_active'] = true;
        $credentials['role_id'] = $this->getRoleByGuard();

        if ($this->guard()->attempt($credentials, $request->filled('remember'))) {
            return $this->sendLoginResponse($request);
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

    public function logout()
    {
        $this->guard()->logout();

        return redirect(route($this->guardName . '.login'));
    }

    public function redirectToProvider()
    {
        $user = auth()->guard($this->guardName)->user();
        $this->guard()->login($user);

        return redirect()->to(route($this->guardName . '.home'));
    }
}
