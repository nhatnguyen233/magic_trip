<?php

namespace App\Repositories\Cart;

use Prettus\Repository\Contracts\RepositoryInterface;

interface CartRepository extends RepositoryInterface
{
    public function addToCart(array $params);

    public function deleteAllCart($session_token);
}
