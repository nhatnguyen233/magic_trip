<?php

namespace App\Repositories\Cart;

use App\Models\Cart;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;

class CartRepositoryEloquent extends BaseRepository implements CartRepository
{
    public function model()
    {
        return Cart::class;
    }

    /**
     * Boot up the repository, pushing criteria
     *
     * @throws RepositoryException
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function addToCart($params)
    {
        try {
            if(isset($params['tour_id']) && $params['tour_id'] != null)
            {
                $check = $this->findWhere(['session_token' => session()->get('session_token'), 'tour_id' => $params['tour_id']]);
            }

            if($check->count() > 0)
            {
                $params['quantity'] += intval($check->pluck('quantity')->first());
                $params['total_price'] = $params['price'] * $params['quantity'];
            }

            $data = array_filter($params, function ($key) {
                return in_array($key, ['session_token', 'tour_name', 'tour_id', 'price', 'quantity', 'discount',
                    'thumbnail', 'start_time', 'end_time', 'total_price', 'expired_at']);
            }, ARRAY_FILTER_USE_KEY);

            return $this->updateOrCreate([
                'session_token' => session()->get('session_token'),
                'tour_id'=> $params['tour_id']
            ],$data);
        } catch (Exception $e) {
            Log::error($e);
            DB::rollBack();
            throw $e;
        }
    }

    public function deleteAllCart($session_token)
    {
        try {
            $carts = $this->model->where('session_token', $session_token);

            return $carts->delete();
        } catch (Exception $e) {
            Log::error($e);
            DB::rollBack();
            throw $e;
        }
    }
}
