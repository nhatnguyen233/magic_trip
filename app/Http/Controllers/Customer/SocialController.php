<?php

namespace App\Http\Controllers\Customer;

use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Auth;

class SocialController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    function createUser($getInfo, $provider)
    {
        $user = $this->userRepository->getUserSocialNetWork($getInfo, $provider);

        return $user;
    }

    public function callback($provider)
    {
        $getInfo = Socialite::driver($provider)->stateless()->user();
        $user = $this->createUser($getInfo, $provider);
        Auth::guard('customer')->login($user);

        return redirect(url('/'));
    }
}
