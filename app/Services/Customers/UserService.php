<?php

namespace App\Services\Customers;

use App\Enums\UserRole;
use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Services\BaseService;

class UserService extends BaseService
{

    public function __construct(User $user, Payment $payment)
    {
        $this->user = $user;
        $this->payment = $payment;
    }

    /**
     * @param array $inputs
     * @return User|array|bool
     */
    public function create(array $dataForm)
    {
        return $this->model->create($dataForm);

    }

   

    public function updateProfile($dataForm)
    {
       
    }


}