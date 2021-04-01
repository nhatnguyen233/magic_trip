<?php

namespace App\Repositories\Payment;

use App\Enums\UserRole;
use App\Models\Payment;
use App\Models\User;
use App\Repositories\Payment\PaymentRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;

class PaymentEloquent extends BaseRepository implements PaymentRepository
{
    public function model()
    {
        return Payment::class;
    }

    /**
     * Boot up the repository, pushing criteria
     * @throws RepositoryException
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function createPaymentInfo(array $inputs)
    {
        try {
            DB::beginTransaction();
                $payment = $this->create(array_merge([
                    'name' => $inputs['name'],
                    'card_number' => $inputs['card_number'],
                    'expire_month' => $inputs['expire_month'],
                    'expire_year' => $inputs['expire_year'],
                    'ccv' => $inputs['ccv'],
                    'security_code' => bcrypt('12345678'),
              ]));
                        
            DB::commit();

            return $payment;

     } catch (\Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
    }

    public function updateBaseInfo(array $params, $user)
    {

    }
}
