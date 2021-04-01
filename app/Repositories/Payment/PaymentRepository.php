<?php

namespace App\Repositories\Payment;

use Prettus\Repository\Contracts\RepositoryInterface;

interface PaymentRepository extends RepositoryInterface
{
    public function createPaymentInfo(array $params);
}
